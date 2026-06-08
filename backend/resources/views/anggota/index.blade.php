@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="flex items-start justify-between mb-8">

    <div>

        <h1 class="text-5xl font-bold text-[#1E1E1E]">
            Data Anggota
        </h1>

        <p class="text-gray-500 text-lg mt-2">
            Kelola data anggota Fatayat NU Sukabumi
        </p>

    </div>

    <div class="flex gap-4">

        <a
          href="/laporan/export/excel"
          class="border border-gray-300 px-6 py-3 rounded-2xl bg-white hover:bg-gray-50"
        >
           Export Excel
        </a>

        <button
            onclick="openTambahModal()"
            class="bg-[#15633D] text-white px-6 py-3 rounded-2xl hover:bg-[#0F5E3A]"
        >
            + Tambah Anggota
        </button>

    </div>

</div>


<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <!-- Total Anggota -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

        <h2 class="text-[32px] font-bold text-[#1D1D1D]">
            {{ number_format($totalAnggota) }}
        </h2>

        <p class="text-[#717182] text-[14px] mt-2">
            Total Anggota
        </p>

    </div>

    <!-- Anggota Aktif -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

        <h2 class="text-[32px] font-bold text-[#15633D]">
            {{ $anggotaAktif }}
        </h2>

        <p class="text-[#717182] text-[14px] mt-2">
            Anggota Aktif
        </p>

    </div>

    <!-- Anggota Baru -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

        <h2 class="text-[32px] font-bold text-[#15633D]">
            {{ $anggotaBaru }}
        </h2>

        <p class="text-[#717182] text-[14px] mt-2">
            Anggota Baru Bulan Ini
        </p>

    </div>

    <!--Terverifikasi-->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">

    <h2 class="text-[32px] font-bold text-[#1D1D1D]">
        {{ $tingkatVerifikasi }}
    </h2>

    <p class="text-[#717182] text-[14px] mt-2">
        Tingkat Verifikasi
    </p>

</div>

</div>

<!-- FILTER -->
<div class="bg-white rounded-3xl p-6 mb-8 shadow-sm flex justify-between items-center gap-4">

    <input
        type="text"
        placeholder="Cari nama, email, atau PAC..."
        class="flex-1 border border-gray-300 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/20"
    >

    <div class="flex gap-3">

        <a
            href="/anggota"
            class="px-6 py-3 rounded-2xl {{ !$status ? 'bg-[#15633D] text-white' : 'border border-gray-300 bg-white' }}"
        >
            Semua
        </a>

        <a
            href="/anggota?status=aktif"
            class="px-6 py-3 rounded-2xl {{ $status == 'aktif' ? 'bg-[#15633D] text-white' : 'border border-gray-300 bg-white' }}"
        >
            Aktif
        </a>

        <a
            href="/anggota?status=tidak_aktif"
            class="px-6 py-3 rounded-2xl {{ $status == 'tidak_aktif' ? 'bg-[#15633D] text-white' : 'border border-gray-300 bg-white' }}"
        >
            Tidak Aktif
        </a>

    </div>

</div>


<!-- TABLE -->
<div class="bg-white rounded-3xl shadow-sm overflow-hidden">

    <table class="w-full">

        <thead class="border-b bg-gray-50">

            <tr class="text-left">

                <th class="p-6 font-semibold">Nama</th>
                <th class="p-6 font-semibold">Email</th>
                <th class="p-6 font-semibold">PAC</th>
                <th class="p-6 font-semibold">Profesi</th>
                <th class="p-6 font-semibold">Status</th>
                <th class="p-6 font-semibold">Tanggal Bergabung</th>
                <th class="p-6 font-semibold text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($anggota as $item)

            <tr class="border-b hover:bg-gray-50">

                <td class="p-6 font-medium">
                    {{ $item->nama }}
                </td>

                <td class="p-6 text-gray-500">
                    {{ $item->email }}
                </td>

                <td class="p-6 text-gray-500">
                    {{ $item->pac }}
                </td>

                <td class="p-6 text-gray-500">
                    {{ $item->profesi }}
                </td>

                <td class="p-6">

                    @if($item->status == 'aktif')

                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                            Aktif
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">
                            Tidak Aktif
                        </span>

                    @endif

                </td>

                <td class="p-6 text-gray-500">
                    {{ $item->tanggal_bergabung }}
                </td>

                <!-- AKSI -->
                <td class="p-6">

                    <div class="flex justify-center gap-4">

                        <!-- DETAIL -->
                        <button
                            onclick="openDetailModal(
                                '{{ $item->id }}',
                                '{{ $item->nama }}',
                                '{{ $item->email }}',
                                '{{ $item->telepon }}',
                                '{{ $item->pac }}',
                                '{{ $item->profesi }}',
                                '{{ $item->pendidikan }}',
                                '{{ $item->tanggal_bergabung }}',
                                '{{ $item->status }}'
                            )"
                            class="text-gray-500 hover:text-black"
                        >
                            👁
                        </button>

                        <!-- EDIT -->
                        <button

                            data-id="{{ $item->id }}"
                            data-nama="{{ $item->nama }}"
                            data-email="{{ $item->email }}"
                            data-telepon="{{ $item->telepon }}"
                            data-pac="{{ $item->pac }}"
                            data-profesi="{{ $item->profesi }}"
                            data-tanggal="{{ $item->tanggal_bergabung }}"
                            data-status="{{ $item->status }}"

                            onclick="openEditModalFromButton(this)"

                            class="text-blue-500 hover:text-blue-700"
                        >
                            ✏
                        </button>

                        <!-- DELETE -->
                        <button

                            data-id="{{ $item->id }}"
                            data-nama="{{ $item->nama }}"

                            onclick="openDeleteModalFromButton(this)"

                            class="text-red-500 hover:text-red-700"
                        >
                            🗑
                        </button>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="text-center p-10 text-gray-500">

                    Belum ada data anggota

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>


<!-- PAGINATION -->
<div class="mt-8">

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
            ? '<span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">Aktif</span>'
            : '<span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">Tidak Aktif</span>';
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

</script>

@endsection