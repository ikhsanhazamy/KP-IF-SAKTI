<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $search = $request->search;

        $query = Anggota::query();

        if ($status === 'aktif') {
            $query->where('status', 'aktif');
        }

        if ($status === 'tidak_aktif') {
            $query->where('status', 'tidak_aktif');
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('pac', 'like', "%{$search}%");
            });
        }

        $anggota = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $stats = Anggota::query()
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'aktif' THEN 1 ELSE 0 END) as aktif,
                SUM(CASE WHEN status = 'tidak_aktif' THEN 1 ELSE 0 END) as tidak_aktif,
                SUM(CASE WHEN email IS NOT NULL AND telepon IS NOT NULL AND tanggal_lahir IS NOT NULL AND pendidikan IS NOT NULL AND profesi IS NOT NULL THEN 1 ELSE 0 END) as terverifikasi
            ")
            ->first();

        $totalAnggota = (int) ($stats->total ?? 0);
        $anggotaAktif = (int) ($stats->aktif ?? 0);
        $anggotaTidakAktif = (int) ($stats->tidak_aktif ?? 0);
        $anggotaTerverifikasi = (int) ($stats->terverifikasi ?? 0);
        $anggotaBaru = Anggota::whereBetween('tanggal_bergabung', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->count();

        $tingkatVerifikasi = $totalAnggota > 0
            ? (int) round(($anggotaTerverifikasi / $totalAnggota) * 100)
            : 0;

        return view('anggota.index', compact(
            'anggota',
            'status',
            'search',
            'totalAnggota',
            'anggotaAktif',
            'anggotaTidakAktif',
            'anggotaBaru',
            'tingkatVerifikasi'
        ));
    }

    public function store(Request $request)
    {
        Anggota::create($request->validate($this->rules()));

        return redirect()->back()
            ->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $imported = 0;
        $skipped = 0;

        foreach ($this->csvRows($request->file('csv_file')) as $row) {
            $email = $this->csvValue($row, ['email']);
            $nama = $this->csvValue($row, ['nama', 'nama_lengkap']);

            if (! $email || ! $nama) {
                $skipped++;

                continue;
            }

            try {
                $tanggalLahir = $this->parseDate($this->csvValue($row, ['tanggal_lahir', 'tgl_lahir', 'dob']));
                $tanggalBergabung = $this->parseDate($this->csvValue($row, ['tanggal_bergabung', 'tgl_bergabung', 'bergabung']));

                if (! $tanggalLahir || ! $tanggalBergabung) {
                    $skipped++;

                    continue;
                }

                Anggota::updateOrCreate(
                    ['email' => $email],
                    [
                        'nama' => $nama,
                        'telepon' => $this->csvValue($row, ['telepon', 'no_telepon', 'phone'], '-'),
                        'tanggal_lahir' => $tanggalLahir,
                        'pac' => $this->csvValue($row, ['pac'], '-'),
                        'profesi' => $this->csvValue($row, ['profesi'], '-'),
                        'pendidikan' => $this->normalizePendidikan($this->csvValue($row, ['pendidikan'], 'SMA')),
                        'status' => $this->normalizeStatus($this->csvValue($row, ['status'], 'aktif')),
                        'status_pernikahan' => $this->normalizeStatusPernikahan(
                            $this->csvValue($row, ['status_pernikahan', 'pernikahan'], 'belum_kawin')
                        ),
                        'tanggal_bergabung' => $tanggalBergabung,
                    ]
                );

                $imported++;
            } catch (\Throwable) {
                $skipped++;
            }
        }

        return redirect()
            ->back()
            ->with('success', "Import anggota selesai. {$imported} data tersimpan, {$skipped} baris dilewati.");
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        return response()->json($anggota);
    }

    public function update(Request $request, int $id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->update($request->validate($this->rules($anggota->id)));

        return redirect()->back()
            ->with('success', 'Data anggota berhasil diupdate');
    }

    public function destroy(int $id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->delete();

        return redirect()->back()
            ->with('success', 'Data anggota berhasil dihapus');
    }

    private function rules(?int $anggotaId = null): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('anggotas', 'email')->ignore($anggotaId),
            ],
            'telepon' => ['required', 'string', 'max:30'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:1900-01-01'],
            'pac' => ['required', 'string', 'max:255'],
            'profesi' => ['required', 'string', 'max:255'],
            'pendidikan' => ['required', Rule::in(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])],
            'status' => ['required', Rule::in(['aktif', 'tidak_aktif'])],
            'status_pernikahan' => ['required', Rule::in(['kawin', 'belum_kawin', 'cerai_hidup', 'cerai_mati'])],
            'tanggal_bergabung' => ['required', 'date'],
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
        $slug = $this->slugValue($value);

        return in_array($slug, ['aktif', 'tidak_aktif'], true) ? $slug : 'aktif';
    }

    private function normalizeStatusPernikahan(?string $value): string
    {
        return match ($this->slugValue($value)) {
            'kawin', 'menikah' => 'kawin',
            'cerai_hidup', 'duda' => 'cerai_hidup',
            'cerai_mati', 'janda' => 'cerai_mati',
            default => 'belum_kawin',
        };
    }

    private function normalizePendidikan(?string $value): string
    {
        $pendidikan = Str::upper(trim((string) $value));

        return in_array($pendidikan, ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'], true)
            ? $pendidikan
            : 'SMA';
    }

    private function slugValue(?string $value): string
    {
        return Str::of($value ?? '')
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/', '_')
            ->trim('_')
            ->toString();
    }
}
