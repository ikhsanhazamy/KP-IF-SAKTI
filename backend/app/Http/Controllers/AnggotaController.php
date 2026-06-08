<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Carbon\Carbon;

class AnggotaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $status = $request->status;
        $search = $request->search;
        
        $totalAnggota = Anggota::count();

        $anggotaTerverifikasi = Anggota::whereNotNull('email')
            ->whereNotNull('telepon')
            ->whereNotNull('pendidikan')
            ->whereNotNull('profesi')
            ->count();

        $tingkatVerifikasi = $totalAnggota > 0
            ? round(($anggotaTerverifikasi / $totalAnggota) * 100)
            : 0;

                $query = Anggota::query();

        // FILTER STATUS
        if ($status == 'aktif') {

            $query->where('status', 'aktif');

        }

        if ($status == 'tidak_aktif') {

            $query->where('status', 'tidak_aktif');

        }

        // SEARCH
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

        // CARD STATISTIK
        $totalAnggota = Anggota::count();

        $anggotaAktif = Anggota::where(
            'status',
            'aktif'
        )->count();

        $anggotaTidakAktif = Anggota::where(
            'status',
            'tidak_aktif'
        )->count();

        $anggotaBaru = Anggota::whereMonth(
            'tanggal_bergabung',
            Carbon::now()->month
        )->whereYear(
            'tanggal_bergabung',
            Carbon::now()->year
        )->count();

        $anggotaTerverifikasi = Anggota::whereNotNull('email')
        ->whereNotNull('telepon')
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

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required',
            'email' => 'required|email|unique:anggotas,email',
            'pac' => 'required',
            'profesi' => 'required',
            'pendidikan' => 'required',
            'status' => 'required',
            'tanggal_bergabung' => 'required',

        ]);

        Anggota::create([

            'nama' => $request->nama,
            'email' => $request->email,
            'pac' => $request->pac,
            'profesi' => $request->profesi,
            'telepon' => $request->telepon,
            'pendidikan' => $request->pendidikan,
            'status' => $request->status,
            'tanggal_bergabung' => $request->tanggal_bergabung,

        ]);

        return redirect()->back()
            ->with('success', 'Data anggota berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        return response()->json($anggota);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, int $id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->update([

            'nama' => $request->nama,
            'email' => $request->email,
            'pac' => $request->pac,
            'profesi' => $request->profesi,
            'telepon' => $request->telepon,
            'pendidikan' => $request->pendidikan,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'status' => $request->status,

        ]);

        return redirect()->back()
            ->with('success', 'Data anggota berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(int $id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->delete();

        return redirect()->back()
            ->with('success', 'Data anggota berhasil dihapus');
    }
}