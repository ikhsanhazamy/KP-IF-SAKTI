<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\PAC;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PACController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HALAMAN PAC
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $query = PAC::query();

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('nama_pac', 'like', "%{$search}%")
                    ->orWhere('kecamatan', 'like', "%{$search}%")
                    ->orWhere('ketua_pac', 'like', "%{$search}%");
            });
        }

        $pacs = (clone $query)->orderBy('id')->paginate(9)->withQueryString();
        $totalPAC = PAC::count();
        $pacAktif = PAC::where('status', 'aktif')->count();
        $totalAnggota = PAC::sum('jumlah_anggota');
        $totalKecamatan = PAC::whereNotNull('kecamatan')
            ->where('kecamatan', '!=', '')
            ->distinct('kecamatan')
            ->count('kecamatan');
        $chartPACs = (clone $query)->orderByDesc('jumlah_anggota')->get();

        $currentMonth = now();
        $previousMonth = now()->subMonthNoOverflow();
        $anggota = Anggota::query()
            ->select('pac', 'tanggal_bergabung')
            ->get();

        $pacs->setCollection(
            $pacs->getCollection()->map(function (PAC $pac) use (
                $anggota,
                $currentMonth,
                $previousMonth
            ) {
                $pacAnggota = $anggota->filter(function (Anggota $item) use ($pac) {
                    $anggotaPAC = $this->normalizePACName($item->pac);
                    $namaPAC = $this->normalizePACName($pac->nama_pac);
                    $kecamatan = $this->normalizePACName($pac->kecamatan);

                    return $anggotaPAC === $namaPAC
                        || $anggotaPAC === $kecamatan
                        || Str::contains($anggotaPAC, $kecamatan);
                });

                $anggotaBulanIni = $pacAnggota->filter(
                    fn (Anggota $item) => Carbon::parse($item->tanggal_bergabung)
                        ->isSameMonth($currentMonth)
                )->count();

                $anggotaBulanLalu = $pacAnggota->filter(
                    fn (Anggota $item) => Carbon::parse($item->tanggal_bergabung)
                        ->isSameMonth($previousMonth)
                )->count();

                $pac->growth = $this->percentageGrowth(
                    $anggotaBulanIni,
                    $anggotaBulanLalu
                );

                return $pac;
            })
        );

        return view('dataPAC', compact(
            'pacs',
            'totalPAC',
            'pacAktif',
            'totalAnggota',
            'totalKecamatan',
            'chartPACs'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA PAC
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated['jumlah_anggota'] ??= 0;
        $validated['alumni_lkd'] ??= 0;

        $pac = PAC::create($validated);
        $page = (int) ceil(PAC::count() / 9);
        $url = $page > 1
            ? route('pac.index', ['page' => $page])
            : route('pac.index');

        return redirect()->to($url.'#pac-'.$pac->id)
            ->with('success', 'PAC berhasil ditambahkan');
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $imported = 0;
        $skipped = 0;

        foreach ($this->csvRows($request->file('csv_file')) as $row) {
            $namaPac = $this->csvValue($row, ['nama_pac', 'pac', 'nama']);
            $kecamatan = $this->csvValue($row, ['kecamatan']);

            if (! $namaPac || ! $kecamatan) {
                $skipped++;

                continue;
            }

            try {
                $tanggalBerdiri = $this->parseDate($this->csvValue($row, ['tanggal_berdiri', 'tgl_berdiri']));

                if (! $tanggalBerdiri) {
                    $skipped++;

                    continue;
                }

                PAC::updateOrCreate(
                    [
                        'nama_pac' => $namaPac,
                        'kecamatan' => $kecamatan,
                    ],
                    [
                        'status' => $this->normalizeStatus($this->csvValue($row, ['status'], 'aktif')),
                        'tanggal_berdiri' => $tanggalBerdiri,
                        'alamat' => $this->csvValue($row, ['alamat'], '-'),
                        'desa' => $this->csvValue($row, ['desa', 'kelurahan'], '-'),
                        'kode_pos' => $this->csvValue($row, ['kode_pos']),
                        'ketua_pac' => $this->csvValue($row, ['ketua_pac', 'ketua'], '-'),
                        'telepon' => $this->csvValue($row, ['telepon', 'no_telepon'], '-'),
                        'email' => $this->csvValue($row, ['email']),
                        'jumlah_anggota' => (int) ($this->csvValue($row, ['jumlah_anggota', 'anggota'], '0')),
                        'alumni_lkd' => (int) ($this->csvValue($row, ['alumni_lkd', 'alumni_lkd_count', 'alumni'], '0')),
                        'nomor_sk' => $this->csvValue($row, ['nomor_sk', 'no_sk']),
                        'deskripsi' => $this->csvValue($row, ['deskripsi', 'keterangan']),
                    ]
                );

                $imported++;
            } catch (\Throwable) {
                $skipped++;
            }
        }

        return redirect()
            ->route('pac.index')
            ->with('success', "Import PAC selesai. {$imported} data tersimpan, {$skipped} baris dilewati.");
    }

    public function exportExcel(): Response
    {
        $content = view('exports.pac-excel', [
            'pacs' => PAC::orderBy('nama_pac')->get(),
        ])->render();

        return response($content, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data-pac.xls"',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PAC
    |--------------------------------------------------------------------------
    */

    public function show(int $id)
    {
        $pac = PAC::findOrFail($id);

        return response()->json($pac);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PAC
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, int $id)
    {
        $pac = PAC::findOrFail($id);

        $validated = $request->validate($this->rules());
        $validated['jumlah_anggota'] ??= 0;
        $validated['alumni_lkd'] ??= 0;

        $pac->update($validated);

        return redirect()->route('pac.index')
            ->with('success', 'PAC berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PAC
    |--------------------------------------------------------------------------
    */

    public function destroy(int $id)
    {
        $pac = PAC::findOrFail($id);

        $pac->delete();

        return redirect()->route('pac.index')
            ->with('success', 'PAC berhasil dihapus');
    }

    private function normalizePACName(?string $name): string
    {
        return Str::of($name ?? '')
            ->lower()
            ->replace(['pac', 'kabupaten', 'kab.', 'kab'], '')
            ->replaceMatches('/[^a-z0-9]+/', ' ')
            ->squish()
            ->toString();
    }

    private function percentageGrowth(int $current, int $previous): int
    {
        if ($previous === 0) {
            return $current > 0 ? 100 : 0;
        }

        return (int) round((($current - $previous) / $previous) * 100);
    }

    private function rules(): array
    {
        return [
            'nama_pac' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['aktif', 'tidak_aktif', 'akan_expire'])],
            'tanggal_berdiri' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'desa' => ['required', 'string', 'max:255'],
            'kode_pos' => ['nullable', 'string', 'max:20'],
            'ketua_pac' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'jumlah_anggota' => ['nullable', 'integer', 'min:0'],
            'nomor_sk' => ['nullable', 'string', 'max:255'],
            'alumni_lkd' => ['nullable', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    private function csvRows($file): array
    {
        $handle = fopen($file->getRealPath(), 'r');
        $firstLine = fgets($handle) ?: '';
        $delimiter = substr_count($firstLine, ';') > substr_count($firstLine, ',') ? ';' : ',';
        rewind($handle);

        $headers = fgetcsv($handle, 0, $delimiter) ?: [];
        $headers = array_map(fn ($header) => $this->normalizeHeader($header), $headers);
        $rows = [];

        while (($line = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (count(array_filter($line, fn ($value) => trim((string) $value) !== '')) === 0) {
                continue;
            }

            $line = array_slice(array_pad($line, count($headers), null), 0, count($headers));
            $rows[] = array_combine($headers, $line);
        }

        fclose($handle);

        return $rows;
    }

    private function normalizeHeader(?string $header): string
    {
        return Str::of($header ?? '')
            ->replace("\xEF\xBB\xBF", '')
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/', '_')
            ->trim('_')
            ->toString();
    }

    private function csvValue(array $row, array $keys, ?string $default = null): ?string
    {
        foreach ($keys as $key) {
            $normalized = $this->normalizeHeader($key);

            if (array_key_exists($normalized, $row) && trim((string) $row[$normalized]) !== '') {
                return trim((string) $row[$normalized]);
            }
        }

        return $default;
    }

    private function parseDate(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        foreach (['Y-m-d', 'd/m/Y', 'd-m-Y', 'm/d/Y'] as $format) {
            try {
                return Carbon::createFromFormat($format, $value)->format('Y-m-d');
            } catch (\Throwable) {
                //
            }
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable) {
            return null;
        }
    }

    private function normalizeStatus(?string $value): string
    {
        $slug = Str::of($value ?? '')
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/', '_')
            ->trim('_')
            ->toString();

        return in_array($slug, ['aktif', 'tidak_aktif', 'akan_expire'], true)
            ? $slug
            : 'aktif';
    }
}
