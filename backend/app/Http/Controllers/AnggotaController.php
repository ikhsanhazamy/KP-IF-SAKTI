<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'aktif')->count();
        $anggotaTidakAktif = Anggota::where('status', 'tidak_aktif')->count();
        $anggotaBaru = Anggota::whereMonth('tanggal_bergabung', Carbon::now()->month)
            ->whereYear('tanggal_bergabung', Carbon::now()->year)
            ->count();

        $anggotaTerverifikasi = Anggota::whereNotNull('email')
            ->whereNotNull('telepon')
            ->whereNotNull('tanggal_lahir')
            ->whereNotNull('pendidikan')
            ->whereNotNull('profesi')
            ->count();

        $tingkatVerifikasi = $totalAnggota > 0
            ? round(($anggotaTerverifikasi / $totalAnggota) * 100)
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
            'tanggal_bergabung' => ['required', 'date'],
        ];
    }
}
