<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\PAC;
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

        // Auto-sync: increment total_kegiatan di PAC terkait
        if ($request->filled('pac_id')) {
            PAC::where('id', $request->pac_id)->increment('total_kegiatan');
        }

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

        // Jika pac_id berubah, update total_kegiatan di PAC lama dan baru
        if ($request->filled('pac_id') && $kegiatan->pac_id != $request->pac_id) {
            if ($kegiatan->pac_id) {
                PAC::where('id', $kegiatan->pac_id)->decrement('total_kegiatan');
            }
            PAC::where('id', $request->pac_id)->increment('total_kegiatan');
        }

        $kegiatan->update([
            'pac_id' => $request->pac_id,
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

        // Auto-sync: decrement total_kegiatan di PAC terkait
        if ($kegiatan->pac_id) {
            PAC::where('id', $kegiatan->pac_id)->decrement('total_kegiatan');
        }

        $kegiatan->delete();

        return redirect('/kegiatan');
    }
}
