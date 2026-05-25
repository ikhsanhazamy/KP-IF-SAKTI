@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex items-start justify-between">

        <div>
            <h1 class="text-5xl font-bold text-[#1E1E1E]">
                Data Anggota
            </h1>

            <p class="text-[#717182] mt-3 text-xl">
                Kelola data anggota Fatayat NU Sukabumi
            </p>
        </div>

        <div class="flex items-center gap-4">

            <!-- EXPORT -->
            <button
                class="flex items-center gap-3 border border-gray-200 bg-white px-7 py-4 rounded-2xl text-xl font-medium hover:bg-gray-50 transition">

                <img
                    src="{{ asset('backend/icons/export.svg') }}"
                    class="w-6 h-6"
                    alt="Export">

                Export

            </button>

            <!-- TAMBAH -->
            <button
                onclick="openTambahModal()"
                class="flex items-center gap-3 bg-[#15633D] hover:bg-[#0F5E3A] text-white px-7 py-4 rounded-2xl text-xl font-medium transition">

                <img
                    src="{{ asset('backend/icons/tambah.svg') }}"
                    class="w-6 h-6"
                    alt="Tambah">

                Tambah Anggota

            </button>

        </div>

    </div>

    <!-- CARD -->
    <div class="grid grid-cols-4 gap-5">

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#1E1E1E]">
                {{ $anggota->count() }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Total Anggota
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#15633D]">
                {{ $anggota->where('status', 'aktif')->count() }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Anggota Aktif
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#15633D]">
                0
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Anggota Baru (Bulan Ini)
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#1E1E1E]">
                98%
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Tingkat Verifikasi
            </p>

        </div>

    </div>

    <!-- SEARCH -->
    <div class="bg-white border border-gray-200 rounded-3xl p-5 flex items-center justify-between gap-5">

        <div class="flex-1">

            <form action="/anggota" method="GET">

                <div class="relative">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, email, atau PAC..."
                        class="w-full border border-gray-200 rounded-2xl py-4 pl-16 pr-5 text-xl outline-none focus:ring-4 focus:ring-[#15633D]/10">

                    <img
                        src="{{ asset('backend/icons/search.svg') }}"
                        class="w-7 h-7 absolute left-5 top-1/2 -translate-y-1/2"
                        alt="Search">

                </div>

            </form>

        </div>

        <!-- FILTER -->
        <div class="flex items-center gap-3">

            <a
                href="/anggota"
                class="px-7 py-4 rounded-2xl text-xl border transition
                {{ !request('status') ? 'bg-[#15633D] text-white border-[#15633D]' : 'bg-white text-[#1E1E1E] border-gray-200' }}">

                Semua

            </a>

            <a
                href="/anggota?status=aktif"
                class="px-7 py-4 rounded-2xl text-xl border transition
                {{ request('status') == 'aktif' ? 'bg-[#15633D] text-white border-[#15633D]' : 'bg-white text-[#1E1E1E] border-gray-200' }}">

                Aktif

            </a>

            <a
                href="/anggota?status=tidak_aktif"
                class="px-7 py-4 rounded-2xl text-xl border transition
                {{ request('status') == 'tidak_aktif' ? 'bg-[#717182] text-white border-[#717182]' : 'bg-white text-[#1E1E1E] border-gray-200' }}">

                Tidak Aktif

            </a>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden">

        <table class="w-full">

            <thead class="border-b border-gray-200">

                <tr class="text-left">

                    <th class="px-7 py-6 text-lg font-semibold">
                        Nama
                    </th>

                    <th class="px-7 py-6 text-lg font-semibold">
                        Email
                    </th>

                    <th class="px-7 py-6 text-lg font-semibold">
                        PAC
                    </th>

                    <th class="px-7 py-6 text-lg font-semibold">
                        Profesi
                    </th>

                    <th class="px-7 py-6 text-lg font-semibold">
                        Status
                    </th>

                    <th class="px-7 py-6 text-lg font-semibold">
                        Tanggal Bergabung
                    </th>

                    <th class="px-7 py-6 text-lg font-semibold text-right">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($anggota as $item)

                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                    <td class="px-7 py-6">

                        <h2 class="text-xl font-semibold text-[#1E1E1E]">
                            {{ $item->nama }}
                        </h2>

                    </td>

                    <td class="px-7 py-6 text-[#717182] text-lg">
                        {{ $item->email }}
                    </td>

                    <td class="px-7 py-6 text-[#717182] text-lg">
                        {{ $item->pac }}
                    </td>

                    <td class="px-7 py-6 text-[#717182] text-lg">
                        {{ $item->profesi }}
                    </td>

                    <td class="px-7 py-6">

                        @if($item->status == 'aktif')

                            <span class="bg-[#EDF7F0] text-[#15633D] px-5 py-2 rounded-full text-sm font-medium">
                                Aktif
                            </span>

                        @else

                            <span class="bg-[#F1F1F3] text-[#717182] px-5 py-2 rounded-full text-sm font-medium">
                                Tidak Aktif
                            </span>

                        @endif

                    </td>

                    <td class="px-7 py-6 text-[#717182] text-lg">

                        {{ \Carbon\Carbon::parse($item->tanggal_bergabung)->format('d/m/Y') }}

                    </td>

                    <td class="px-7 py-6">

                        <div class="flex items-center justify-end gap-5">

                            @php
                                $tanggalGabung = \Carbon\Carbon::parse($item->tanggal_bergabung)
                                    ->translatedFormat('d F Y');
                            @endphp

                            <!-- VIEW -->
                            <button
                                    onclick="openDetailModal(
                                        '{{ $item->nama }}',
                                        '{{ $item->email }}',
                                        '{{ $item->telepon }}',
                                        '{{ $item->pac }}',
                                        '{{ $item->profesi }}',
                                        '{{ $item->status }}',
                                        '{{ $tanggalGabung }}',
                                        '{{ $item->id }}'
                                    )"
                                >
                                <img
                                    src="{{ asset('backend/icons/view.svg') }}"
                                    class="w-6 h-6"
                                    alt="View">

                            </button>

                            <!-- EDIT -->
                            <button>

                                <img
                                    src="{{ asset('backend/icons/edit.svg') }}"
                                    class="w-6 h-6"
                                    alt="Edit">

                            </button>

                            <!-- DELETE -->
                            <button>

                                <img
                                    src="{{ asset('backend/icons/delete.svg') }}"
                                    class="w-6 h-6"
                                    alt="Delete">

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="7"
                        class="text-center py-20 text-[#717182] text-xl">

                        Data anggota belum tersedia

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <!-- PAGINATION -->
        <div class="p-7 flex items-center justify-between">

            <p class="text-[#717182] text-lg">

                Menampilkan
                {{ $anggota->firstItem() ?? 0 }}
                -
                {{ $anggota->lastItem() ?? 0 }}
                dari
                {{ $anggota->total() }}
                anggota

            </p>

            {{ $anggota->links() }}

        </div>

    </div>

</div>

@include('partials.modalTambahAnggota')
@include('partials.modalDetailAnggota')

<!-- SCRIPT -->
<script>

    function openTambahModal()
    {
        document
            .getElementById('modalTambah')
            .classList
            .remove('hidden');

        document
            .getElementById('modalTambah')
            .classList
            .add('flex');
    }

    function closeTambahModal()
    {
        document
            .getElementById('modalTambah')
            .classList
            .remove('flex');

        document
            .getElementById('modalTambah')
            .classList
            .add('hidden');
    }

    function openDetailModal(
        nama,
        email,
        telepon,
        pac,
        profesi,
        status,
        tanggal,
        id
    )
    {
        document.getElementById('detailNama').innerText = nama;
        document.getElementById('detailEmail').innerText = email;
        document.getElementById('detailTelepon').innerText = telepon;
        document.getElementById('detailPac').innerText = pac;
        document.getElementById('detailProfesi').innerText = profesi;
        document.getElementById('detailTanggal').innerText = tanggal;
        document.getElementById('detailId').innerText = '#' + id;

        const statusElement =
            document.getElementById('detailStatus');

        if(status == 'aktif')
        {
            statusElement.innerText = 'Aktif';

            statusElement.className =
                'bg-[#EDF7F0] text-[#15633D] px-5 py-2 rounded-full text-sm font-medium';
        }
        else
        {
            statusElement.innerText = 'Tidak Aktif';

            statusElement.className =
                'bg-[#F1F1F3] text-[#717182] px-5 py-2 rounded-full text-sm font-medium';
        }

        document
            .getElementById('modalDetail')
            .classList
            .remove('hidden');

        document
            .getElementById('modalDetail')
            .classList
            .add('flex');
    }

    function closeDetailModal()
    {
        document
            .getElementById('modalDetail')
            .classList
            .remove('flex');

        document
            .getElementById('modalDetail')
            .classList
            .add('hidden');
    }

</script>

@endsection