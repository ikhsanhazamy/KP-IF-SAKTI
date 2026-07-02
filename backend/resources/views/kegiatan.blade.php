@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex items-start justify-between">

        <div>

            <h1 class="text-5xl font-bold text-[#1E1E1E]">
                Manajemen Kegiatan
            </h1>

            <p class="text-[#717182] mt-3 text-xl">
                Kelola kegiatan dan program Fatayat NU Sukabumi
            </p>

        </div>

        <!-- BUTTON -->
        <button
            onclick="openTambahKegiatanModal()"
            class="flex items-center gap-3 bg-[#15633D] hover:bg-[#0F5E3A] text-white px-7 py-4 rounded-2xl text-xl font-medium transition"
        >

            <span class="text-2xl leading-none">+</span>

            <span>Tambah Kegiatan</span>

        </button>

    </div>

    <!-- STAT -->
    <div class="grid grid-cols-4 gap-5">

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold">
                {{ $kegiatan->count() }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Total Kegiatan
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-blue-600">
                {{ $kegiatan->where('status', 'upcoming')->count() }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Upcoming
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-green-600">
                {{ $kegiatan->where('status', 'ongoing')->count() }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Ongoing
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-gray-500">
                {{ $kegiatan->where('status', 'completed')->count() }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Completed
            </p>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#FAFAFA]">

                <tr class="text-left">

                    <th class="px-8 py-6 font-semibold">
                        Kegiatan
                    </th>

                    <th class="px-8 py-6 font-semibold">
                        Tanggal
                    </th>

                    <th class="px-8 py-6 font-semibold">
                        Lokasi
                    </th>

                    <th class="px-8 py-6 font-semibold">
                        Kategori
                    </th>

                    <th class="px-8 py-6 font-semibold">
                        Peserta
                    </th>

                    <th class="px-8 py-6 font-semibold">
                        Status
                    </th>

                    <th class="px-8 py-6 font-semibold text-right">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($kegiatan as $item)

                <tr id="kegiatan-{{ $item->id }}" class="scroll-mt-6 border-t border-gray-100 hover:bg-gray-50 transition">

                    <td class="px-8 py-6">

                        <div class="flex items-center gap-4">
                            @if($item->gambar_url)
                                <img
                                    src="{{ $item->gambar_url }}"
                                    alt="Gambar {{ $item->judul }}"
                                    class="h-16 w-24 rounded-2xl object-cover border border-gray-100"
                                >
                            @else
                                <div class="flex h-16 w-24 items-center justify-center rounded-2xl border border-dashed border-gray-200 bg-gray-50 text-xs text-gray-400">
                                    No Image
                                </div>
                            @endif

                            <div>
                                <h3 class="font-semibold text-lg">
                                    {{ $item->judul }}
                                </h3>

                                <p class="text-sm text-[#717182] mt-1">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                        </div>

                    </td>

                    <td class="px-8 py-6 text-[#717182]">

                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                        <br>

                        {{ $item->waktu }}

                    </td>

                    <td class="px-8 py-6 text-[#717182]">
                        {{ $item->lokasi }}
                    </td>

                    <td class="px-8 py-6">

                        <span class="bg-[#EDF7F0] text-[#15633D] px-4 py-2 rounded-full text-sm">

                            {{ $item->kategori }}

                        </span>

                    </td>

                    <td class="px-8 py-6 text-[#717182]">

                        {{ $item->peserta }}

                    </td>

                    <td class="px-8 py-6">

                        @if($item->status == 'upcoming')

                            <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm">
                                Upcoming
                            </span>

                        @elseif($item->status == 'ongoing')

                            <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm">
                                Ongoing
                            </span>

                        @else

                            <span class="bg-gray-200 text-gray-600 px-4 py-2 rounded-full text-sm">
                                Completed
                            </span>

                        @endif

                    </td>

                    <td class="px-8 py-6">

                        <div class="flex justify-end gap-4">

                            <button
                                type="button"
                                data-id="{{ $item->id }}"
                                onclick="openEditKegiatanModal(this.dataset.id)"
                                class="flex h-11 w-11 items-center justify-center rounded-2xl border border-gray-200 text-[#4B5563] hover:bg-gray-100 transition"
                                aria-label="Edit kegiatan"
                            >
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" />
                                </svg>
                            </button>

                            <form action="/kegiatan/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex h-11 w-11 items-center justify-center rounded-2xl border border-red-100 bg-red-50 text-red-600 hover:bg-red-100 transition" aria-label="Hapus kegiatan">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 6h18" />
                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                        <path d="M10 11v6" />
                                        <path d="M14 11v6" />
                                    </svg>
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center py-16 text-gray-400">

                        Belum ada data kegiatan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@include('partials.modalTambahKegiatan')

<script>

    function openTambahKegiatanModal()
    {
        resetKegiatanModal();
        document
            .getElementById('modalTambahKegiatan')
            .classList
            .remove('hidden');

        document
            .getElementById('modalTambahKegiatan')
            .classList
            .add('flex');
    }

    function openEditKegiatanModal(id)
    {
        fetch(`/kegiatan/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response not ok');
                }

                return response.json();
            })
            .then(data => {
                document.getElementById('kegiatanModalTitle').textContent = 'Edit Kegiatan';
                document.getElementById('kegiatanSubmitButton').textContent = 'Update';

                const form = document.getElementById('kegiatanForm');
                form.action = `/kegiatan/update/${id}`;
                document.getElementById('kegiatanMethod').value = 'PUT';

                document.getElementById('judul').value = data.judul || '';
                document.getElementById('tanggal').value = data.tanggal || '';
                document.getElementById('waktu').value = data.waktu || '';
                document.getElementById('lokasi').value = data.lokasi || '';
                document.getElementById('kategori').value = data.kategori || '';
                document.getElementById('peserta').value = data.peserta || '';
                document.getElementById('status').value = data.status || 'upcoming';
                document.getElementById('deskripsi').value = data.deskripsi || '';
                setGambarPreview(data.gambar_url || '');

                document
                    .getElementById('modalTambahKegiatan')
                    .classList
                    .remove('hidden');

                document
                    .getElementById('modalTambahKegiatan')
                    .classList
                    .add('flex');
            })
            .catch(() => {
                alert('Gagal memuat data kegiatan. Silakan coba lagi.');
            });
    }

    function closeTambahKegiatanModal()
    {
        resetKegiatanModal();
        document
            .getElementById('modalTambahKegiatan')
            .classList
            .remove('flex');

        document
            .getElementById('modalTambahKegiatan')
            .classList
            .add('hidden');
    }

    function resetKegiatanModal()
    {
        document.getElementById('kegiatanModalTitle').textContent = 'Tambah Kegiatan Baru';
        document.getElementById('kegiatanSubmitButton').textContent = 'Simpan';

        const form = document.getElementById('kegiatanForm');
        form.action = '/kegiatan/store';
        document.getElementById('kegiatanMethod').value = 'POST';

        document.getElementById('judul').value = '';
        document.getElementById('tanggal').value = '';
        document.getElementById('waktu').value = '';
        document.getElementById('lokasi').value = '';
        document.getElementById('kategori').value = '';
        document.getElementById('peserta').value = '';
        document.getElementById('status').value = 'upcoming';
        document.getElementById('deskripsi').value = '';
        document.getElementById('gambar').value = '';
        setGambarInfo('');
        setGambarPreview('');
    }

    let currentGambarPreviewUrl = '';

    function setGambarPreview(src)
    {
        const wrapper = document.getElementById('gambarPreviewWrapper');
        const preview = document.getElementById('gambarPreview');

        if (!wrapper || !preview) {
            return;
        }

        if (currentGambarPreviewUrl && currentGambarPreviewUrl.startsWith('blob:')) {
            URL.revokeObjectURL(currentGambarPreviewUrl);
            currentGambarPreviewUrl = '';
        }

        if (src) {
            preview.src = src;
            currentGambarPreviewUrl = src;
            wrapper.classList.remove('hidden');
            return;
        }

        preview.removeAttribute('src');
        wrapper.classList.add('hidden');
    }

    function setGambarInfo(message, isError = false)
    {
        const info = document.getElementById('gambarInfo');

        if (!info) {
            return;
        }

        info.textContent = message;
        info.classList.toggle('text-red-500', isError);
        info.classList.toggle('text-gray-400', !isError);
    }

    function formatFileSize(bytes)
    {
        if (!bytes) {
            return '0 KB';
        }

        const units = ['B', 'KB', 'MB'];
        let size = bytes;
        let unitIndex = 0;

        while (size >= 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex += 1;
        }

        return `${size.toFixed(unitIndex === 0 ? 0 : 1)} ${units[unitIndex]}`;
    }

    function compressImageFile(file)
    {
        return new Promise((resolve, reject) => {
            const image = new Image();
            const objectUrl = URL.createObjectURL(file);

            image.onload = () => {
                URL.revokeObjectURL(objectUrl);

                const maxSize = 1280;
                const scale = Math.min(maxSize / image.width, maxSize / image.height, 1);
                const width = Math.max(1, Math.round(image.width * scale));
                const height = Math.max(1, Math.round(image.height * scale));
                const canvas = document.createElement('canvas');

                canvas.width = width;
                canvas.height = height;

                const context = canvas.getContext('2d');

                if (!context) {
                    reject(new Error('Canvas tidak tersedia'));
                    return;
                }

                context.fillStyle = '#ffffff';
                context.fillRect(0, 0, width, height);
                context.drawImage(image, 0, 0, width, height);

                canvas.toBlob((blob) => {
                    if (!blob) {
                        reject(new Error('Gambar gagal dikompres'));
                        return;
                    }

                    const filename = file.name.replace(/\.[^.]+$/, '') || 'gambar-kegiatan';

                    resolve(new File([blob], `${filename}.jpg`, {
                        type: 'image/jpeg',
                        lastModified: Date.now(),
                    }));
                }, 'image/jpeg', 0.75);
            };

            image.onerror = () => {
                URL.revokeObjectURL(objectUrl);
                reject(new Error('Gambar tidak bisa dibaca'));
            };

            image.src = objectUrl;
        });
    }

    document.getElementById('gambar')?.addEventListener('change', async (event) => {
        const input = event.target;
        const file = input.files?.[0];
        const submitButton = document.getElementById('kegiatanSubmitButton');

        if (!file) {
            setGambarPreview('');
            setGambarInfo('');
            return;
        }

        if (!file.type.startsWith('image/')) {
            input.value = '';
            setGambarPreview('');
            setGambarInfo('File harus berupa gambar JPG, PNG, atau WebP.', true);
            return;
        }

        setGambarPreview(URL.createObjectURL(file));
        setGambarInfo(`Mengompres ${formatFileSize(file.size)}...`);

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-60', 'cursor-wait');
        }

        try {
            const compressed = await compressImageFile(file);
            const dataTransfer = new DataTransfer();

            dataTransfer.items.add(compressed);
            input.files = dataTransfer.files;

            setGambarPreview(URL.createObjectURL(compressed));
            setGambarInfo(`Dikompres dari ${formatFileSize(file.size)} menjadi ${formatFileSize(compressed.size)} sebelum upload.`);
        } catch (error) {
            setGambarInfo('Gambar gagal dikompres di browser. File asli tetap akan diproses oleh server.', true);
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-60', 'cursor-wait');
            }
        }
    });

    document.getElementById('kegiatanForm')?.addEventListener('submit', async (event) => {
        const form = event.currentTarget;

        if (form.dataset.csrfRefreshed === 'true') {
            delete form.dataset.csrfRefreshed;
            return;
        }

        event.preventDefault();

        const submitButton = document.getElementById('kegiatanSubmitButton');

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-60', 'cursor-wait');
        }

        try {
            const response = await fetch('/csrf-token', {
                headers: {
                    Accept: 'application/json',
                },
                credentials: 'same-origin',
                cache: 'no-store',
            });

            if (response.ok) {
                const data = await response.json();
                const tokenInput = form.querySelector('input[name="_token"]');

                if (tokenInput && data.token) {
                    tokenInput.value = data.token;
                }
            }
        } finally {
            form.dataset.csrfRefreshed = 'true';
            form.submit();
        }
    });

</script>

@endsection
