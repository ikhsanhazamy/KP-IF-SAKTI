@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-[26px] font-bold text-gray-900 tracking-tight">
            Data Anggota
        </h1>
        <p class="text-[#717182] mt-1 text-[14px] font-medium">
            Kelola data anggota Pimpinan Cabang Fatayat NU Sukabumi
        </p>
    </div>
    <div class="flex gap-3">
        <a href="/laporan/export/excel"
           class="border border-gray-200 hover:bg-gray-50 transition text-gray-700 px-5 py-2.5 rounded-xl text-sm font-semibold cursor-pointer shadow-sm bg-white">
            Export Excel
        </a>
        <button onclick="openTambahModal()"
                class="bg-[#0F5E3A] hover:bg-[#0b4e30] transition text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-1.5 cursor-pointer shadow-sm">
            <span class="text-lg leading-none">+</span>
            <span>Tambah Anggota</span>
        </button>
    </div>
</div>

<!-- STATS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Anggota -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-[116px]">
        <h2 class="text-2xl font-bold text-gray-900 leading-none">
            {{ number_format($totalAnggota) }}
        </h2>
        <p class="text-xs text-gray-400 font-medium">
            Total Anggota
        </p>
    </div>

    <!-- Anggota Aktif -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-[116px]">
        <h2 class="text-2xl font-bold text-[#0F5E3A] leading-none">
            {{ number_format($anggotaAktif) }}
        </h2>
        <p class="text-xs text-gray-400 font-medium">
            Anggota Aktif
        </p>
    </div>

    <!-- Anggota Baru -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-[116px]">
        <h2 class="text-2xl font-bold text-[#0F5E3A] leading-none">
            {{ number_format($anggotaBaru) }}
        </h2>
        <p class="text-xs text-gray-400 font-medium">
            Anggota Baru Bulan Ini
        </p>
    </div>

    <!-- Terverifikasi -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between h-[116px]">
        <h2 class="text-2xl font-bold text-gray-900 leading-none">
            {{ $tingkatVerifikasi }}%
        </h2>
        <p class="text-xs text-gray-400 font-medium">
            Tingkat Verifikasi
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
            id="searchAnggota"
            placeholder="Cari nama, email, atau PAC..."
            class="w-full bg-[#f6f8f7] border-0 rounded-xl pl-11 pr-4 py-3 text-[14px] text-gray-800 placeholder-gray-400 outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 transition"
            value="{{ $search }}"
        >
    </div>
    <div class="flex gap-2 w-full sm:w-auto shrink-0 justify-end">
        <a href="/anggota{{ $search ? '?search=' . $search : '' }}"
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition duration-200 {{ !$status ? 'bg-[#0F5E3A] text-white shadow-sm' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
            Semua
        </a>
        <a href="/anggota?status=aktif{{ $search ? '&search=' . $search : '' }}"
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition duration-200 {{ $status == 'aktif' ? 'bg-[#0F5E3A] text-white shadow-sm' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
            Aktif
        </a>
        <a href="/anggota?status=tidak_aktif{{ $search ? '&search=' . $search : '' }}"
           class="px-4 py-2.5 rounded-xl text-xs font-bold transition duration-200 {{ $status == 'tidak_aktif' ? 'bg-[#0F5E3A] text-white shadow-sm' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
            Tidak Aktif
        </a>
    </div>
</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50/70 border-b border-gray-100">
                <tr class="text-left">
                    <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">PAC</th>
                    <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Profesi</th>
                    <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Bergabung</th>
                    <th class="px-6 py-4.5 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($anggota as $item)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 text-[13px] font-semibold text-gray-900">
                        {{ $item->nama }}
                    </td>
                    <td class="px-6 py-4 text-[13px] text-gray-500">
                        {{ $item->email }}
                    </td>
                    <td class="px-6 py-4 text-[13px] text-gray-500">
                        PAC {{ $item->pac }}
                    </td>
                    <td class="px-6 py-4 text-[13px] text-gray-500">
                        {{ $item->profesi }}
                    </td>
                    <td class="px-6 py-4 text-[13px]">
                        @if($item->status == 'aktif')
                            <span class="inline-flex items-center bg-[#eef3f0] text-[#0F5E3A] px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                                Tidak Aktif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-[13px] text-gray-500">
                        {{ \Carbon\Carbon::parse($item->tanggal_bergabung)->translatedFormat('d M Y') }}
                    </td>
                    <!-- AKSI -->
                    <td class="px-6 py-4 text-center">
                        <div class="inline-flex justify-center gap-2">
                            <!-- DETAIL -->
                            <button
                                onclick="openDetailModal(
                                    '{{ $item->id }}',
                                    '{{ $item->nama }}',
                                    '{{ $item->email }}',
                                    '{{ $item->telepon }}',
                                    '{{ $item->pac }}',
                                    '{{ $item->pendidikan }}',
                                    '{{ $item->profesi }}',
                                    '{{ \Carbon\Carbon::parse($item->tanggal_bergabung)->translatedFormat('d M Y') }}',
                                    '{{ $item->status }}'
                                )"
                                class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-500 hover:text-gray-900 flex items-center justify-center transition cursor-pointer"
                                title="Lihat Detail"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <!-- EDIT -->
                            <button
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-email="{{ $item->email }}"
                                data-telepon="{{ $item->telepon }}"
                                data-pac="{{ $item->pac }}"
                                data-pendidikan="{{ $item->pendidikan }}"
                                data-profesi="{{ $item->profesi }}"
                                data-tanggal="{{ $item->tanggal_bergabung }}"
                                data-status="{{ $item->status }}"
                                onclick="openEditModalFromButton(this)"
                                class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-500 hover:text-blue-700 flex items-center justify-center transition cursor-pointer"
                                title="Edit Anggota"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <!-- DELETE -->
                            <button
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                onclick="openDeleteModalFromButton(this)"
                                class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 flex items-center justify-center transition cursor-pointer"
                                title="Hapus Anggota"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-[13px] text-gray-400">
                        Belum ada data anggota.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $anggota->links() }}
</div>

@include('partials.modalTambahAnggota')
@include('partials.modalDetailAnggota')
@include('partials.modalEditAnggota')
@include('partials.modalHapusAnggota')


<script>

    /*
    |--------------------------------------------------------------------------
    | TAMBAH MODAL
    |--------------------------------------------------------------------------
    */
     
    function openTambahModal()
    {
        document
            .getElementById('modalTambah')
            .classList.remove('hidden');

        document
            .getElementById('modalTambah')
            .classList.add('flex');
    }

    function closeTambahModal()
    {
        document
            .getElementById('modalTambah')
            .classList.remove('flex');

        document
            .getElementById('modalTambah')
            .classList.add('hidden');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL MODAL
    |--------------------------------------------------------------------------
    */

    function openDetailModal(
        id,
        nama,
        email,
        telepon,
        pac,
        pendidikan,
        profesi,
        tanggal,
        status
    )
    {
        document
            .getElementById('modalDetail')
            .classList.remove('hidden');

        document
            .getElementById('modalDetail')
            .classList.add('flex');

        document.getElementById('detailId').innerText = id;
        document.getElementById('detailNama').innerText = nama;
        document.getElementById('detailEmail').innerText = email;
        document.getElementById('detailTelepon').innerText = telepon;
        document.getElementById('detailPac').innerText = pac;
        document.getElementById('detailPendidikan').innerText = pendidikan;
        document.getElementById('detailProfesi').innerText = profesi;
        document.getElementById('detailTanggal').innerText = tanggal;

        document.getElementById('detailStatus').innerHTML =
            status === 'aktif'
            ? '<span class="inline-flex items-center bg-[#eef3f0] text-[#0F5E3A] px-2.5 py-0.5 rounded-full text-[11px] font-bold">Aktif</span>'
            : '<span class="inline-flex items-center bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full text-[11px] font-bold">Tidak Aktif</span>';
    }

    function closeDetailModal()
    {
        document
            .getElementById('modalDetail')
            .classList.remove('flex');

        document
            .getElementById('modalDetail')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT MODAL
    |--------------------------------------------------------------------------
    |
    */

    function openEditModalFromButton(button)
    {
        document
            .getElementById('modalEdit')
            .classList.remove('hidden');

        document
            .getElementById('modalEdit')
            .classList.add('flex');

        document.getElementById('editNama').value =
            button.dataset.nama;

        document.getElementById('editEmail').value =
            button.dataset.email;

        document.getElementById('editTelepon').value =
            button.dataset.telepon;

        document.getElementById('editPac').value =
            button.dataset.pac;
        
        document.getElementById('editPendidikan').value =
            button.dataset.pendidikan;

        document.getElementById('editProfesi').value =
            button.dataset.profesi;

        document.getElementById('editTanggal').value =
            button.dataset.tanggal;

        document.getElementById('editStatus').value =
            button.dataset.status;

        document
            .getElementById('formEditAnggota')
            .action = `/anggota/update/${button.dataset.id}`;
    }

    function closeEditModal()
    {
        document
            .getElementById('modalEdit')
            .classList.remove('flex');

        document
            .getElementById('modalEdit')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE MODAL
    |--------------------------------------------------------------------------
    |
    */

    function openDeleteModalFromButton(button)
    {
        document
            .getElementById('modalHapus')
            .classList.remove('hidden');

        document
            .getElementById('modalHapus')
            .classList.add('flex');

        document.getElementById('hapusText').innerText =
            `Yakin ingin menghapus ${button.dataset.nama}?`;

        document
            .getElementById('formDeleteAnggota')
            .action = `/anggota/delete/${button.dataset.id}`;
    }

    function closeDeleteModal()
    {
        document
            .getElementById('modalHapus')
            .classList.remove('flex');

        document
            .getElementById('modalHapus')
            .classList.add('hidden');
    }

    // SEARCH LISTENER
    document.getElementById('searchAnggota').addEventListener('keypress', function (e) {
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

</script>

@endsection