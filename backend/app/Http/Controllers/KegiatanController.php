<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\PAC;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $search = $request->search;

        $query = Kegiatan::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $kegiatan = $query->latest()->get();

        return view('kegiatan', compact('kegiatan', 'search', 'status'));
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

        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'tanggal'  => 'required|date',
            'waktu'    => 'required|string',
            'lokasi'   => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'peserta'  => 'required|integer|min:0',
            'pac_id'   => 'nullable|exists:pacs,id',
            'deskripsi'=> 'nullable|string',
            'status'   => 'required|in:upcoming,ongoing,completed',
        ]);

        $oldPacId = $kegiatan->pac_id;
        $newPacId = $validated['pac_id'] ?? null;

        if ($oldPacId != $newPacId) {
            if ($oldPacId) {
                PAC::where('id', $oldPacId)->decrement('total_kegiatan');
            }
            if ($newPacId) {
                PAC::where('id', $newPacId)->increment('total_kegiatan');
            }
        }

        $kegiatan->update($validated);

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
