<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();

        return view('kegiatan', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        Kegiatan::create($request->all());

        return redirect('/kegiatan');
    }

    public function show(int $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return response()->json($kegiatan);
    }

    public function update(Request $request, int $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'kategori' => $request->kategori,
            'peserta' => $request->peserta,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/kegiatan');
    }

    public function destroy(int $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->delete();

        return redirect('/kegiatan');
    }
}
