<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KegiatanApiController extends Controller
{
    /**
     * Display a listing of kegiatan.
     * Supports search, category filter, and pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Kegiatan::with('pac:id,nama_pac,kecamatan');

        if ($request->filled('search')) {
            $escaped = addcslashes($request->search, '%_\\');
            $query->where(function ($q) use ($escaped) {
                $q->where('judul', 'like', "%{$escaped}%")
                    ->orWhere('deskripsi', 'like', "%{$escaped}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->whereRaw('LOWER(kategori) = ?', [strtolower($request->category)]);
        }

        // Allow explicitly requesting all items if paginate=false
        if ($request->has('paginate') && filter_var($request->paginate, FILTER_VALIDATE_BOOLEAN) === false) {
            return response()->json($query->latest()->get());
        }

        $perPage = (int) $request->input('per_page', 12);
        if ($perPage <= 0 || $perPage > 50) {
            $perPage = 12;
        }

        $paginated = $query->latest()->paginate($perPage);

        return response()->json($paginated);
    }

    /**
     * Display the specified kegiatan with PAC relation.
     */
    public function show($id): JsonResponse
    {
        $kegiatan = Kegiatan::with('pac:id,nama_pac,kecamatan')->findOrFail($id);

        return response()->json($kegiatan);
    }
}
