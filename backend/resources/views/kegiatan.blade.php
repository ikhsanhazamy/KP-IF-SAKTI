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

                <tr class="border-t border-gray-100 hover:bg-gray-50 transition">

                    <td class="px-8 py-6">

                        <h3 class="font-semibold text-lg">
                            {{ $item->judul }}
                        </h3>

                        <p class="text-sm text-[#717182] mt-1">
                            {{ $item->deskripsi }}
                        </p>

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

                            <button>

                                <img
                                    src="{{ asset('backend/icons/edit.svg') }}"
                                    class="w-5 h-5"
                                    alt=""
                                >

                            </button>

                            <button>

                                <img
                                    src="{{ asset('backend/icons/delete.svg') }}"
                                    class="w-5 h-5"
                                    alt=""
                                >

                            </button>

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
        document
            .getElementById('modalTambahKegiatan')
            .classList
            .remove('hidden');

        document
            .getElementById('modalTambahKegiatan')
            .classList
            .add('flex');
    }

    function closeTambahKegiatanModal()
    {
        document
            .getElementById('modalTambahKegiatan')
            .classList
            .remove('flex');

        document
            .getElementById('modalTambahKegiatan')
            .classList
            .add('hidden');
    }

</script>

@endsection