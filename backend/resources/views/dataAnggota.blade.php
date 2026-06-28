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
            <a
                href="/laporan/export/excel"
                class="flex items-center gap-3 border border-gray-200 bg-white px-7 py-4 rounded-2xl text-xl font-medium hover:bg-gray-50 transition"
            >
                <svg
                    class="h-7 w-7"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <path d="M12 3v11"></path>
                    <path d="m7.5 9.5 4.5 4.5 4.5-4.5"></path>
                    <path d="M4 16v2.5A2.5 2.5 0 0 0 6.5 21h11a2.5 2.5 0 0 0 2.5-2.5V16"></path>
                </svg>
                Export
            </a>

            <!-- TAMBAH -->
            <button
                onclick="openTambahModal()"
                class="flex items-center gap-3 bg-[#15633D] hover:bg-[#0F5E3A] text-white px-7 py-4 rounded-2xl text-xl font-medium transition">

                <svg
                    class="h-7 w-7"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.9"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <circle cx="9" cy="7" r="3"></circle>
                    <path d="M3.5 20v-1.5A4.5 4.5 0 0 1 8 14h2a4.5 4.5 0 0 1 4.5 4.5V20"></path>
                    <path d="M18 8v6M15 11h6"></path>
                </svg>

                Tambah Anggota

            </button>

        </div>

    </div>

    <!-- CARD STATISTIK -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- TOTAL ANGGOTA -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

        <h2 class="text-[32px] font-bold text-[#1D1D1D]">
            {{ $anggota->total() }}
        </h2>

        <p class="text-[#717182] text-[14px] mt-2">
            Total Anggota
        </p>

    </div>

    <!-- AKTIF -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

        <h2 class="text-[32px] font-bold text-[#4FA36C]">
            {{ $anggota->where('status','aktif')->count() }}
        </h2>

        <p class="text-[#717182] text-[14px] mt-2">
            Anggota Aktif
        </p>

    </div>

    <!-- BARU BULAN INI -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

        <h2 class="text-[32px] font-bold text-[#15633D]">
            {{ $anggotaBaru }}
        </h2>

        <p class="text-[#717182] text-[14px] mt-2">
            Anggota Baru (Bulan Ini)
        </p>

    </div>

    <!-- VERIFIKASI -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

        <h2 class="text-[32px] font-bold text-[#1D1D1D]">
            100%
        </h2>

        <p class="text-[#717182] text-[14px] mt-2">
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
                class="whitespace-nowrap px-7 py-4 rounded-2xl text-xl border transition
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

                            <span class="inline-flex whitespace-nowrap bg-[#EDF7F0] text-[#15633D] px-5 py-2 rounded-full text-sm font-medium">
                                Aktif
                            </span>

                        @else

                            <span class="inline-flex whitespace-nowrap bg-[#F1F1F3] text-[#717182] px-5 py-2 rounded-full text-sm font-medium">
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
                            <button
                                onclick="openEditModalFromButton(this)"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-email="{{ $item->email }}"
                                data-telepon="{{ $item->telepon }}"
                                data-pac="{{ $item->pac }}"
                                data-profesi="{{ $item->profesi }}"
                                data-tanggal="{{ $item->tanggal_bergabung }}"
                                data-status="{{ $item->status }}"
                            >

                                <img
                                    src="{{ asset('backend/icons/edit.svg') }}"
                                    class="w-6 h-6"
                                    alt="Edit">

                            </button>

                            <!-- DELETE -->
                            <button
                                onclick="openDeleteModalFromButton(this)"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                            >

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
                'inline-flex whitespace-nowrap bg-[#EDF7F0] text-[#15633D] px-5 py-2 rounded-full text-sm font-medium';
        }
        else
        {
            statusElement.innerText = 'Tidak Aktif';

            statusElement.className =
                'inline-flex whitespace-nowrap bg-[#F1F1F3] text-[#717182] px-5 py-2 rounded-full text-sm font-medium';
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

    /*
    |--------------------------------------------------------------------------
    | EDIT / DELETE
    |--------------------------------------------------------------------------
    */

    function openEditModal(id, nama, email, telepon, pac, profesi, tanggal, status)
    {
        document.getElementById('editNama').value = nama;
        document.getElementById('editEmail').value = email;
        document.getElementById('editTelepon').value = telepon;
        document.getElementById('editPac').value = pac;
        document.getElementById('editProfesi').value = profesi;
        document.getElementById('editTanggal').value = tanggal;
        document.getElementById('editStatus').value = status;

        document.getElementById('formEditAnggota').action = `/anggota/update/${id}`;

        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('modalEdit').classList.add('flex');
    }

    function closeEditModal()
    {
        document.getElementById('modalEdit').classList.remove('flex');
        document.getElementById('modalEdit').classList.add('hidden');
    }

    function openDeleteModal(id, nama)
    {
        document.getElementById('hapusText').innerText = `Hapus anggota "${nama}"? Tindakan ini tidak bisa dibatalkan.`;
        document.getElementById('formDeleteAnggota').action = `/anggota/delete/${id}`;

        document.getElementById('modalHapus').classList.remove('hidden');
        document.getElementById('modalHapus').classList.add('flex');
    }

    function closeDeleteModal()
    {
        document.getElementById('modalHapus').classList.remove('flex');
        document.getElementById('modalHapus').classList.add('hidden');
    }

    function openEditModalFromButton(button) {
        const id = button.dataset.id;
        const nama = button.dataset.nama;
        const email = button.dataset.email;
        const telepon = button.dataset.telepon;
        const pac = button.dataset.pac;
        const profesi = button.dataset.profesi;
        const tanggal = button.dataset.tanggal;
        const status = button.dataset.status;

        openEditModal(id, nama, email, telepon, pac, profesi, tanggal, status);
    }

    function openDeleteModalFromButton(button) {
        const id = button.dataset.id;
        const nama = button.dataset.nama;

        openDeleteModal(id, nama);
    }

</script>

@include('partials.modalTambahAnggota')
@include('partials.modalDetailAnggota')
@include('partials.modalEditAnggota')
@include('partials.modalHapusAnggota')

@endsection
