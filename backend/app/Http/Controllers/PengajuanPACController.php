<?php

namespace App\Http\Controllers;

use App\Models\PAC;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengajuanPACController extends Controller
{
    /**
     * Tampilkan halaman daftar pengajuan PAC
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'pending');
        $search = trim((string) $request->query('search', ''));

        $query = PAC::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $escaped = addcslashes($search, '%_\\');
            $query->where(function ($builder) use ($escaped) {
                $builder->where('nama_pac', 'like', "%{$escaped}%")
                    ->orWhere('kecamatan', 'like', "%{$escaped}%")
                    ->orWhere('ketua_pac', 'like', "%{$escaped}%")
                    ->orWhere('telepon', 'like', "%{$escaped}%");
            });
        }

        $pengajuans = (clone $query)->orderByDesc('id')->paginate(10)->withQueryString();

        $countPending = PAC::where('status', 'pending')->count();
        $countAktif = PAC::where('status', 'aktif')->count();
        $countDitolak = PAC::where('status', 'ditolak')->count();
        $countTotal = PAC::count();

        return view('pengajuanPAC', compact(
            'pengajuans',
            'status',
            'search',
            'countPending',
            'countAktif',
            'countDitolak',
            'countTotal'
        ));
    }

    /**
     * Detail data pengajuan PAC (JSON response untuk AJAX modal)
     */
    public function show(int $id): JsonResponse
    {
        $pac = PAC::findOrFail($id);

        return response()->json([
            'id' => $pac->id,
            'nama_pac' => $pac->nama_pac,
            'kecamatan' => $pac->kecamatan,
            'desa' => $pac->desa ?? '-',
            'alamat' => $pac->alamat ?? '-',
            'kode_pos' => $pac->kode_pos ?? '-',
            'ketua_pac' => $pac->ketua_pac,
            'telepon' => $pac->telepon,
            'email' => $pac->email ?? '-',
            'status' => $pac->status,
            'nomor_sk' => $pac->nomor_sk ?? '-',
            'jumlah_anggota' => $pac->jumlah_anggota ?? 0,
            'alumni_lkd' => $pac->alumni_lkd ?? 0,
            'tanggal_berdiri' => $pac->tanggal_berdiri ? \Carbon\Carbon::parse($pac->tanggal_berdiri)->format('d F Y') : '-',
            'raw_tanggal_berdiri' => $pac->tanggal_berdiri,
            'deskripsi' => $pac->deskripsi ?? 'Tidak ada keterangan tambahan.',
            'created_at' => $pac->created_at ? $pac->created_at->format('d F Y H:i') : '-',
            'created_at_relative' => $pac->created_at ? $pac->created_at->diffForHumans() : '-',
        ]);
    }

    /**
     * Setujui pengajuan PAC (Ubah status menjadi 'aktif')
     */
    public function approve(Request $request, int $id): RedirectResponse
    {
        $pac = PAC::findOrFail($id);

        $request->validate([
            'nomor_sk' => ['nullable', 'string', 'max:255'],
        ]);

        $pac->status = 'aktif';

        if ($request->filled('nomor_sk')) {
            $pac->nomor_sk = trim($request->input('nomor_sk'));
        }

        $pac->save();

        return redirect()->back()->with('success', "Pengajuan {$pac->nama_pac} berhasil disetujui! Status kini resmi AKTIF.");
    }

    /**
     * Tolak pengajuan PAC (Ubah status menjadi 'ditolak')
     */
    public function reject(Request $request, int $id): RedirectResponse
    {
        $pac = PAC::findOrFail($id);

        $request->validate([
            'alasan_penolakan' => ['nullable', 'string', 'max:500'],
        ]);

        $pac->status = 'ditolak';

        if ($request->filled('alasan_penolakan')) {
            $alasan = trim($request->input('alasan_penolakan'));
            $pac->deskripsi = trim(($pac->deskripsi ? $pac->deskripsi."\n\n[Catatan Penolakan Admin]: " : '[Catatan Penolakan Admin]: ').$alasan);
        }

        $pac->save();

        return redirect()->back()->with('success', "Pengajuan {$pac->nama_pac} telah ditolak.");
    }
}
