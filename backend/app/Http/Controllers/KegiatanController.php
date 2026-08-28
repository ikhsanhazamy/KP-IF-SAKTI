<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\PAC;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $search = $request->search;

        $query = Kegiatan::with('pac');

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $escaped = addcslashes($search, '%_\\');
            $query->where(function ($q) use ($escaped) {
                $q->where('judul', 'like', "%{$escaped}%")
                    ->orWhere('lokasi', 'like', "%{$escaped}%")
                    ->orWhere('kategori', 'like', "%{$escaped}%")
                    ->orWhere('deskripsi', 'like', "%{$escaped}%");
            });
        }

        $kegiatan = $query->latest()->get();
        $pacs = PAC::orderBy('nama_pac')->get();

        return view('kegiatan', compact('kegiatan', 'search', 'status', 'pacs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->storeCompressedImage($request->file('gambar'));
        }

        Kegiatan::create($validated);

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

        $validated = $request->validate($this->rules());

        if ($request->hasFile('gambar')) {
            $newImage = $this->storeCompressedImage($request->file('gambar'));

            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $validated['gambar'] = $newImage;
        } else {
            unset($validated['gambar']);
        }

        $kegiatan->update($validated);

        return redirect('/kegiatan');
    }

    public function destroy(int $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->gambar) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect('/kegiatan');
    }

    private function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['required', 'string'],
            'lokasi' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'peserta' => ['required', 'integer', 'min:0'],
            'pac_id' => ['nullable', 'exists:pacs,id'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'in:upcoming,ongoing,completed'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:30720'],
        ];
    }

    private function storeCompressedImage(UploadedFile $file): string
    {
        if (! function_exists('imagecreatefromstring') || ! function_exists('imagejpeg')) {
            throw ValidationException::withMessages([
                'gambar' => 'Ekstensi GD PHP belum aktif, sehingga gambar tidak bisa dikompres.',
            ]);
        }

        $contents = file_get_contents($file->getRealPath());
        $source = $contents === false ? false : @imagecreatefromstring($contents);

        if (! $source) {
            throw ValidationException::withMessages([
                'gambar' => 'Gambar tidak bisa diproses. Gunakan file JPG, PNG, atau WebP yang valid.',
            ]);
        }

        $source = $this->normalizeOrientation($source, $file);

        $sourceWidth = imagesx($source);
        $sourceHeight = imagesy($source);
        $maxSize = 1280;
        $scale = min($maxSize / $sourceWidth, $maxSize / $sourceHeight, 1);
        $targetWidth = max(1, (int) round($sourceWidth * $scale));
        $targetHeight = max(1, (int) round($sourceHeight * $scale));

        $target = imagecreatetruecolor($targetWidth, $targetHeight);
        $background = imagecolorallocate($target, 255, 255, 255);
        imagefilledrectangle($target, 0, 0, $targetWidth, $targetHeight, $background);

        imagecopyresampled(
            $target,
            $source,
            0,
            0,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $sourceWidth,
            $sourceHeight
        );

        $path = 'kegiatan/'.Str::uuid().'.jpg';
        $tempPath = tempnam(sys_get_temp_dir(), 'kegiatan_');

        try {
            if (! $tempPath || ! imagejpeg($target, $tempPath, 75)) {
                throw ValidationException::withMessages([
                    'gambar' => 'Gambar gagal dikompres. Silakan coba file lain.',
                ]);
            }

            Storage::disk('public')->makeDirectory('kegiatan');
            $compressed = file_get_contents($tempPath);

            if ($compressed === false || ! Storage::disk('public')->put($path, $compressed)) {
                throw ValidationException::withMessages([
                    'gambar' => 'Gambar gagal disimpan. Silakan coba kembali.',
                ]);
            }
        } finally {
            imagedestroy($source);
            imagedestroy($target);

            if ($tempPath && file_exists($tempPath)) {
                @unlink($tempPath);
            }
        }

        return $path;
    }

    private function normalizeOrientation($image, UploadedFile $file)
    {
        if ($file->getMimeType() !== 'image/jpeg' || ! function_exists('exif_read_data')) {
            return $image;
        }

        $exif = @exif_read_data($file->getRealPath());
        $orientation = $exif['Orientation'] ?? null;

        $rotated = match ($orientation) {
            3 => imagerotate($image, 180, 0),
            6 => imagerotate($image, -90, 0),
            8 => imagerotate($image, 90, 0),
            default => false,
        };

        if ($rotated) {
            imagedestroy($image);

            return $rotated;
        }

        return $image;
    }
}
