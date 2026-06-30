<?php

namespace App\Http\Controllers;

use App\Models\PAC;
use Illuminate\Http\Request;

class PACController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HALAMAN PAC
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $status = $request->status;
        $search = $request->search;

        $query = PAC::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pac', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('ketua_pac', 'like', "%{$search}%")
                  ->orWhere('desa', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $pacs = $query->latest()->paginate(9)->withQueryString();

        $totalPAC = PAC::count();

        $pacAktif = PAC::where('status', 'aktif')->count();

        $totalAnggota = PAC::sum('jumlah_anggota');

        $totalKecamatan = PAC::distinct()->count('kecamatan');

        return view('dataPAC', compact(
            'pacs',
            'totalPAC',
            'pacAktif',
            'totalAnggota',
            'totalKecamatan',
            'search',
            'status'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA PAC
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nama_pac' => 'required',
            'kecamatan' => 'required',
            'status' => 'required',
            'tanggal_berdiri' => 'required',

            'alamat' => 'required',
            'desa' => 'required',

            'ketua_pac' => 'required',
            'telepon' => 'required',

        ]);

        PAC::create([

            'nama_pac' => $request->nama_pac,
            'kecamatan' => $request->kecamatan,
            'status' => $request->status,
            'tanggal_berdiri' => $request->tanggal_berdiri,

            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kode_pos' => $request->kode_pos,

            'ketua_pac' => $request->ketua_pac,
            'telepon' => $request->telepon,
            'email' => $request->email,

            'jumlah_anggota' => $request->jumlah_anggota ?? 0,

            'deskripsi' => $request->deskripsi,
            'nomor_sk' => $request->nomor_sk,
            'total_kegiatan' => $request->total_kegiatan ?? 0,

        ]);

        return redirect()->route('pac.index')
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

        // Bug 6 Fix: Validasi input — same rules as store()
        $request->validate([
            'nama_pac'       => 'required|string|max:255',
            'kecamatan'      => 'required|string|max:255',
            'status'         => 'required|in:aktif,tidak_aktif',
            'tanggal_berdiri'=> 'required|date',
            'alamat'         => 'required|string',
            'desa'           => 'required|string',
            'ketua_pac'      => 'required|string|max:255',
            'telepon'        => 'required|string|max:20',
        ]);

        $pac->update([
            'nama_pac'        => $request->nama_pac,
            'kecamatan'       => $request->kecamatan,
            'status'          => $request->status,
            'tanggal_berdiri' => $request->tanggal_berdiri,
            'alamat'          => $request->alamat,
            'desa'            => $request->desa,
            'kode_pos'        => $request->kode_pos,
            'ketua_pac'       => $request->ketua_pac,
            'telepon'         => $request->telepon,
            'email'           => $request->email,
            'jumlah_anggota'  => $request->jumlah_anggota,
            'nomor_sk'        => $request->nomor_sk,
            'total_kegiatan'  => $request->total_kegiatan,
            'deskripsi'       => $request->deskripsi,
        ]);

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

}