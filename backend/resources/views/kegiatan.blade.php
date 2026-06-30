@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-[26px] font-bold text-gray-900 tracking-tight">
                Manajemen Kegiatan
            </h1>
            <p class="text-[#717182] mt-1 text-[14px] font-medium">
                Kelola kegiatan dan program Fatayat NU Sukabumi
            </p>
        </div>
        <button
            onclick="openTambahKegiatanModal()"
            class="bg-[#0F5E3A] hover:bg-[#0b4e30] transition text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-1.5 cursor-pointer shadow-sm"
        >
            <span class="text-lg leading-none">+</span>
            <span>Tambah Kegiatan</span>
        </button>
    </div>

    <!-- STAT -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-gray-900 leading-none">
                {{ $kegiatan->count() }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                Total Kegiatan
            </p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-blue-600 leading-none">
                {{ $kegiatan->where('status', 'upcoming')->count() }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                Upcoming
            </p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-[#0F5E3A] leading-none">
                {{ $kegiatan->where('status', 'ongoing')->count() }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                Ongoing
            </p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-gray-400 leading-none">
                {{ $kegiatan->where('status', 'completed')->count() }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                Completed
            </p>
        </div>
    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="relative flex-1 w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input
                type="text"
                id="searchKegiatan"
                placeholder="Cari judul, lokasi, kategori, atau deskripsi..."
                class="w-full bg-[#f6f8f7] border-0 rounded-xl pl-11 pr-4 py-3 text-[14px] text-gray-800 placeholder-gray-400 outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 transition"
                value="{{ $search ?? '' }}"
            >
        </div>
        <div class="flex gap-2 w-full sm:w-auto shrink-0 justify-end">
            <a href="/kegiatan{{ $search ? '?search=' . $search : '' }}"
               class="px-4 py-2.5 rounded-xl text-xs font-bold transition duration-200 {{ !$status ? 'bg-[#0F5E3A] text-white shadow-sm' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                Semua
            </a>
            <a href="/kegiatan?status=upcoming{{ $search ? '&search=' . $search : '' }}"
               class="px-4 py-2.5 rounded-xl text-xs font-bold transition duration-200 {{ $status == 'upcoming' ? 'bg-[#0F5E3A] text-white shadow-sm' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                Upcoming
            </a>
            <a href="/kegiatan?status=ongoing{{ $search ? '&search=' . $search : '' }}"
               class="px-4 py-2.5 rounded-xl text-xs font-bold transition duration-200 {{ $status == 'ongoing' ? 'bg-[#0F5E3A] text-white shadow-sm' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                Ongoing
            </a>
            <a href="/kegiatan?status=completed{{ $search ? '&search=' . $search : '' }}"
               class="px-4 py-2.5 rounded-xl text-xs font-bold transition duration-200 {{ $status == 'completed' ? 'bg-[#0F5E3A] text-white shadow-sm' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                Completed
            </a>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50/70 border-b border-gray-100">
                    <tr class="text-left">
                        <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kegiatan</th>
                        <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Peserta</th>
                        <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($kegiatan as $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-[13px]">
                            <h3 class="font-bold text-gray-900">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">
                                {{ $item->deskripsi }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-[13px] text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                            <div class="text-xs text-gray-400 mt-0.5">{{ $item->waktu }} WIB</div>
                        </td>
                        <td class="px-6 py-4 text-[13px] text-gray-500">
                            {{ $item->lokasi }}
                        </td>
                        <td class="px-6 py-4 text-[13px]">
                            <span class="inline-flex items-center bg-[#eef3f0] text-[#0F5E3A] px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-[13px] text-gray-500 font-semibold">
                            {{ $item->peserta }} Orang
                        </td>
                        <td class="px-6 py-4 text-[13px]">
                            @if($item->status == 'upcoming')
                                <span class="inline-flex items-center bg-blue-50 text-blue-600 px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                                    Upcoming
                                </span>
                            @elseif($item->status == 'ongoing')
                                <span class="inline-flex items-center bg-[#eef3f0] text-[#0F5E3A] px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                                    Ongoing
                                </span>
                            @else
                                <span class="inline-flex items-center bg-gray-100 text-gray-400 px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                                    Completed
                                </span>
                            @endif
                        </td>
                        <!-- AKSI -->
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex justify-center gap-2">
                                <!-- EDIT -->
                                <button
                                    type="button"
                                    onclick="openEditKegiatanModal({{ $item->id }})"
                                    class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-500 hover:text-blue-700 flex items-center justify-center transition cursor-pointer"
                                    title="Edit Kegiatan"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <!-- DELETE -->
                                <form action="/kegiatan/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 flex items-center justify-center transition cursor-pointer"
                                        title="Hapus Kegiatan"
                                    >
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-[13px] text-gray-400">
                            Belum ada data kegiatan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
    }

    // SEARCH LISTENER FOR KEGIATAN
    const searchKegiatan = document.getElementById('searchKegiatan');
    if (searchKegiatan) {
        searchKegiatan.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const queryParams = new URLSearchParams(window.location.search);
                if (this.value.trim() !== '') {
                    queryParams.set('search', this.value.trim());
                } else {
                    queryParams.delete('search');
                }
                window.location.search = queryParams.toString();
            }
        });
    }

</script>

@endsection