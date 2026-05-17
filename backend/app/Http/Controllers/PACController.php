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

    public function index()
    {
        $pacs = PAC::latest()->paginate(9);

        $totalPAC = PAC::count();

        $pacAktif = PAC::where('status', 'aktif')->count();

        $totalAnggota = PAC::sum('jumlah_anggota');

        $totalKecamatan = PAC::distinct('kecamatan')->count();

        return view('dataPAC', compact(
            'pacs',
            'totalPAC',
            'pacAktif',
            'totalAnggota',
            'totalKecamatan'
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

            'ketua' => 'required',
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

            'ketua' => $request->ketua,
            'telepon' => $request->telepon,
            'email' => $request->email,

            'jumlah_anggota' => $request->jumlah_anggota ?? 0,

            'deskripsi' => $request->deskripsi,

        ]);

        return redirect('/data-pac')
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

    public function update(Request $request,int $id)
    {
        $pac = PAC::findOrFail($id);

        $pac->update([

            'nama_pac' => $request->nama_pac,
            'kecamatan' => $request->kecamatan,
            'status' => $request->status,
            'tanggal_berdiri' => $request->tanggal_berdiri,

            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kode_pos' => $request->kode_pos,

            'ketua' => $request->ketua,
            'telepon' => $request->telepon,
            'email' => $request->email,

            'jumlah_anggota' => $request->jumlah_anggota,

            'deskripsi' => $request->deskripsi,

        ]);

        return redirect('/data-pac')
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

        return redirect('/data-pac')
            ->with('success', 'PAC berhasil dihapus');
    }

}