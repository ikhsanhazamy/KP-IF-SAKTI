@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col items-start justify-between gap-5 xl:flex-row">
    <div>
        <h1 class="text-4xl font-bold text-[#1E1E1E] lg:text-5xl">Data Anggota</h1>
        <p class="mt-2 text-lg text-gray-500">Kelola data anggota Fatayat NU Sukabumi</p>
    </div>

    <div class="flex gap-4">
        <a href="/laporan/export/excel" class="inline-flex items-center gap-2 rounded-2xl border border-gray-300 bg-white px-6 py-3 hover:bg-gray-50">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 3v11"></path>
                <path d="m7.5 9.5 4.5 4.5 4.5-4.5"></path>
                <path d="M4 16v2.5A2.5 2.5 0 0 0 6.5 21h11a2.5 2.5 0 0 0 2.5-2.5V16"></path>
            </svg>
            Export Excel
        </a>
        <button onclick="openTambahModal()" class="inline-flex items-center gap-2 rounded-2xl bg-[#15633D] px-6 py-3 text-white hover:bg-[#0F5E3A]">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="9" cy="7" r="3"></circle>
                <path d="M3.5 20v-1.5A4.5 4.5 0 0 1 8 14h2a4.5 4.5 0 0 1 4.5 4.5V20"></path>
                <path d="M18 8v6M15 11h6"></path>
            </svg>
            Tambah Anggota
        </button>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 rounded-2xl bg-green-50 px-5 py-4 text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="text-[32px] font-bold text-[#1D1D1D]">{{ number_format($totalAnggota) }}</h2>
        <p class="mt-2 text-[14px] text-[#717182]">Total Anggota</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="text-[32px] font-bold text-[#15633D]">{{ $anggotaAktif }}</h2>
        <p class="mt-2 text-[14px] text-[#717182]">Anggota Aktif</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="text-[32px] font-bold text-[#15633D]">{{ $anggotaBaru }}</h2>
        <p class="mt-2 text-[14px] text-[#717182]">Anggota Baru Bulan Ini</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="text-[32px] font-bold text-[#1D1D1D]">{{ $tingkatVerifikasi }}%</h2>
        <p class="mt-2 text-[14px] text-[#717182]">Tingkat Verifikasi</p>
    </div>
</div>

<div class="mb-8 flex flex-col items-center justify-between gap-4 rounded-3xl bg-white p-6 shadow-sm xl:flex-row">
    <form action="/anggota" method="GET" class="w-full flex-1">
        @if($status)
            <input type="hidden" name="status" value="{{ $status }}">
        @endif
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari nama, email, atau PAC..."
            class="w-full rounded-2xl border border-gray-300 px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/20"
        >
    </form>

    <div class="flex gap-3">
        <a href="/anggota" class="rounded-2xl px-6 py-3 {{ !$status ? 'bg-[#15633D] text-white' : 'border border-gray-300 bg-white' }}">Semua</a>
        <a href="/anggota?status=aktif" class="rounded-2xl px-6 py-3 {{ $status === 'aktif' ? 'bg-[#15633D] text-white' : 'border border-gray-300 bg-white' }}">Aktif</a>
        <a href="/anggota?status=tidak_aktif" class="whitespace-nowrap rounded-2xl px-6 py-3 {{ $status === 'tidak_aktif' ? 'bg-[#15633D] text-white' : 'border border-gray-300 bg-white' }}">Tidak Aktif</a>
    </div>
</div>

<div class="overflow-x-auto rounded-3xl bg-white shadow-sm">
    <table class="w-full min-w-[1100px]">
        <thead class="border-b bg-gray-50">
            <tr class="text-left">
                <th class="p-6 font-semibold">Nama</th>
                <th class="p-6 font-semibold">Email</th>
                <th class="p-6 font-semibold">PAC</th>
                <th class="p-6 font-semibold">Profesi</th>
                <th class="p-6 font-semibold">Umur</th>
                <th class="p-6 font-semibold">Status</th>
                <th class="p-6 font-semibold">Tanggal Bergabung</th>
                <th class="p-6 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggota as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-6 font-medium">{{ $item->nama }}</td>
                    <td class="p-6 text-gray-500">{{ $item->email }}</td>
                    <td class="p-6 text-gray-500">{{ $item->pac }}</td>
                    <td class="p-6 text-gray-500">{{ $item->profesi }}</td>
                    <td class="whitespace-nowrap p-6 text-gray-500">{{ $item->umur ? $item->umur.' tahun' : '-' }}</td>
                    <td class="p-6">
                        @if($item->status === 'aktif')
                            <span class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-4 py-2 text-sm text-green-700">Aktif</span>
                        @else
                            <span class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-4 py-2 text-sm text-red-700">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap p-6 text-gray-500">{{ $item->tanggal_bergabung?->format('d/m/Y') }}</td>
                    <td class="p-6">
                        <div class="flex justify-center gap-4">
                            <button
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-email="{{ $item->email }}"
                                data-telepon="{{ $item->telepon }}"
                                data-pac="{{ $item->pac }}"
                                data-profesi="{{ $item->profesi }}"
                                data-pendidikan="{{ $item->pendidikan }}"
                                data-tanggal-lahir="{{ $item->tanggal_lahir?->format('Y-m-d') }}"
                                data-umur="{{ $item->umur }}"
                                data-tanggal="{{ $item->tanggal_bergabung?->format('Y-m-d') }}"
                                data-status="{{ $item->status }}"
                                onclick="openDetailModalFromButton(this)"
                                class="text-gray-500 hover:text-black"
                                aria-label="Lihat detail anggota"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                                    <circle cx="12" cy="12" r="2.5" stroke-width="1.8"/>
                                </svg>
                            </button>

                            <button
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-email="{{ $item->email }}"
                                data-telepon="{{ $item->telepon }}"
                                data-pac="{{ $item->pac }}"
                                data-profesi="{{ $item->profesi }}"
                                data-pendidikan="{{ $item->pendidikan }}"
                                data-tanggal-lahir="{{ $item->tanggal_lahir?->format('Y-m-d') }}"
                                data-tanggal="{{ $item->tanggal_bergabung?->format('Y-m-d') }}"
                                data-status="{{ $item->status }}"
                                onclick="openEditModalFromButton(this)"
                                class="text-blue-500 hover:text-blue-700"
                                aria-label="Edit anggota"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16.862 4.487 2.651 2.651M7.5 19.5l3.572-.714a2 2 0 0 0 1.016-.547l7.425-7.425a1.875 1.875 0 0 0 0-2.652l-3.675-3.675a1.875 1.875 0 0 0-2.652 0L5.761 11.912a2 2 0 0 0-.547 1.016L4.5 16.5v3h3Z"/>
                                </svg>
                            </button>

                            <button
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                onclick="openDeleteModalFromButton(this)"
                                class="text-red-500 hover:text-red-700"
                                aria-label="Hapus anggota"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16m-10 4v6m4-6v6M9 7l1-2h4l1 2m-9 0 1 13h10l1-13"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-10 text-center text-gray-500">Belum ada data anggota</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-8">{{ $anggota->links() }}</div>

@include('partials.modalTambahAnggota')
@include('partials.modalDetailAnggota')
@include('partials.modalEditAnggota')
@include('partials.modalHapusAnggota')

<script>
    function showModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function hideModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function openTambahModal() {
        showModal('modalTambah');
    }

    function closeTambahModal() {
        hideModal('modalTambah');
    }

    function openDetailModalFromButton(button) {
        showModal('modalDetail');

        document.getElementById('detailId').innerText = button.dataset.id;
        document.getElementById('detailNama').innerText = button.dataset.nama;
        document.getElementById('detailEmail').innerText = button.dataset.email;
        document.getElementById('detailTelepon').innerText = button.dataset.telepon;
        document.getElementById('detailPac').innerText = button.dataset.pac;
        document.getElementById('detailProfesi').innerText = button.dataset.profesi;
        document.getElementById('detailPendidikan').innerText = button.dataset.pendidikan;
        document.getElementById('detailTanggalLahir').innerText = formatTanggal(button.dataset.tanggalLahir);
        document.getElementById('detailUmur').innerText = button.dataset.umur ? `${button.dataset.umur} tahun` : '-';
        document.getElementById('detailTanggal').innerText = formatTanggal(button.dataset.tanggal);
        document.getElementById('detailStatus').innerHTML = button.dataset.status === 'aktif'
            ? '<span class="inline-flex whitespace-nowrap rounded-full bg-green-100 px-4 py-2 text-sm text-green-700">Aktif</span>'
            : '<span class="inline-flex whitespace-nowrap rounded-full bg-red-100 px-4 py-2 text-sm text-red-700">Tidak Aktif</span>';
    }

    function closeDetailModal() {
        hideModal('modalDetail');
    }

    function openEditModalFromButton(button) {
        showModal('modalEdit');

        document.getElementById('editNama').value = button.dataset.nama;
        document.getElementById('editEmail').value = button.dataset.email;
        document.getElementById('editTelepon').value = button.dataset.telepon;
        document.getElementById('editPac').value = button.dataset.pac;
        document.getElementById('editProfesi').value = button.dataset.profesi;
        document.getElementById('editPendidikan').value = button.dataset.pendidikan;
        document.getElementById('editTanggalLahir').value = button.dataset.tanggalLahir;
        document.getElementById('editTanggal').value = button.dataset.tanggal;
        document.getElementById('editStatus').value = button.dataset.status;
        document.getElementById('formEditAnggota').action = `/anggota/update/${button.dataset.id}`;
    }

    function closeEditModal() {
        hideModal('modalEdit');
    }

    function openDeleteModalFromButton(button) {
        showModal('modalHapus');
        document.getElementById('hapusText').innerText = `Yakin ingin menghapus ${button.dataset.nama}?`;
        document.getElementById('formDeleteAnggota').action = `/anggota/delete/${button.dataset.id}`;
    }

    function closeDeleteModal() {
        hideModal('modalHapus');
    }

    function formatTanggal(value) {
        if (!value) {
            return '-';
        }

        const [year, month, day] = value.split('-');
        return `${day}/${month}/${year}`;
    }

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', openTambahModal);
    @endif
</script>
@endsection
