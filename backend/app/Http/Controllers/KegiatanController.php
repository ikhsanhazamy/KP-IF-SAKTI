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
        // Bug 8 Fix: Validasi input sebelum create — cegah IntegrityConstraintViolationException
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'tanggal'  => 'required|date',
            'waktu'    => 'required|string',
            'lokasi'   => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'peserta'  => 'required|integer|min:0',
            'pac_id'   => 'nullable|exists:pacs,id',
            'deskripsi'=> 'nullable|string',
            'status'   => 'nullable|string',
        ]);

        $kegiatan = Kegiatan::create($validated);

        // Auto-sync: increment total_kegiatan di PAC terkait
        if ($request->filled('pac_id')) {
            PAC::where('id', $request->pac_id)->increment('total_kegiatan');
        }

        return redirect('/kegiatan')
            ->with('success', 'Kegiatan berhasil ditambahkan');
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
