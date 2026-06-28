<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\PAC;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PACController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HALAMAN PAC
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pacs = PAC::orderBy('id')->paginate(9);
        $totalPAC = PAC::count();
        $pacAktif = PAC::where('status', 'aktif')->count();
        $totalAnggota = PAC::sum('jumlah_anggota');
        $totalKecamatan = PAC::distinct('kecamatan')->count();
        $chartPACs = PAC::orderByDesc('jumlah_anggota')->get();

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
        $validated['total_kegiatan'] ??= 0;

        $pac = PAC::create($validated);
        $page = (int) ceil(PAC::count() / 9);
        $url = $page > 1
            ? route('pac.index', ['page' => $page])
            : route('pac.index');

        return redirect()->to($url.'#pac-'.$pac->id)
            ->with('success', 'PAC berhasil ditambahkan');
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
        $validated['total_kegiatan'] ??= 0;

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
            'status' => ['required', Rule::in(['aktif', 'tidak_aktif'])],
            'tanggal_berdiri' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'desa' => ['required', 'string', 'max:255'],
            'kode_pos' => ['nullable', 'string', 'max:20'],
            'ketua_pac' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'jumlah_anggota' => ['nullable', 'integer', 'min:0'],
            'nomor_sk' => ['nullable', 'string', 'max:255'],
            'total_kegiatan' => ['nullable', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }
}
