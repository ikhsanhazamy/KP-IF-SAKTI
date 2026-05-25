@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex items-start justify-between">

        <div>

            <h1 class="text-5xl font-bold text-[#1E1E1E]">
                Manajemen PAC
            </h1>

            <p class="text-[#717182] mt-3 text-xl">
                Kelola data Pimpinan Anak Cabang se-Sukabumi
            </p>

        </div>

        <button
            onclick="openTambahPACModal()"
            class="flex items-center gap-3 bg-[#15633D] hover:bg-[#0F5E3A] text-white px-7 py-4 rounded-2xl text-xl font-medium transition"
        >

            <span class="text-2xl leading-none">+</span>

            <span>Tambah PAC</span>

        </button>

    </div>


    <!-- STATISTIC -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#1E1E1E]">
                {{ $totalPAC }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Total PAC
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#15633D]">
                {{ $pacAktif }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                PAC Aktif
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#15633D]">
                {{ $totalAnggota }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Total Anggota
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-5xl font-bold text-[#1E1E1E]">
                {{ $totalKecamatan }}
            </h2>

            <p class="text-[#717182] mt-2 text-xl">
                Kecamatan
            </p>

        </div>

    </div>


    <!-- CHART -->
    <div class="bg-white border border-gray-200 rounded-3xl p-7">

        <h2 class="text-2xl font-bold mb-8">
            Distribusi Anggota per PAC
        </h2>

        <div class="h-[350px]">

            <canvas id="statusPacChart"></canvas>

            <div id="pac-data" class="hidden"
                 data-labels='@json($pacs->pluck("kecamatan")->values())'
                 data-jumlah='@json($pacs->pluck("jumlah_anggota")->values())'>
            </div>

        </div>

    </div>


    <!-- PAC GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @foreach($pacs as $pac)

        <div class="bg-white border border-gray-200 rounded-3xl p-6">

            <!-- TOP -->
            <div class="flex items-start justify-between">

                <div>

                    <h2 class="text-3xl font-bold text-[#1E1E1E]">
                        {{ $pac->nama_pac }}
                    </h2>

                    <p class="text-[#717182] mt-2">
                        Kecamatan {{ $pac->kecamatan }}
                    </p>

                </div>

                <span class="bg-[#EDF7F0] text-[#15633D] px-4 py-2 rounded-full text-sm">
                    {{ ucfirst($pac->status) }}
                </span>

            </div>


            <!-- STATS -->
            <div class="grid grid-cols-3 gap-4 mt-8">

                <div class="bg-[#F8F8F8] rounded-2xl p-4 text-center">

                    <h3 class="text-3xl font-bold text-[#15633D]">
                        {{ $pac->jumlah_anggota }}
                    </h3>

                    <p class="text-[#717182] text-sm mt-1">
                        Anggota
                    </p>

                </div>

                <div class="bg-[#F8F8F8] rounded-2xl p-4 text-center">

                    <h3 class="text-3xl font-bold text-[#15633D]">
                        18
                    </h3>

                    <p class="text-[#717182] text-sm mt-1">
                        Kegiatan
                    </p>

                </div>

                <div class="bg-[#F8F8F8] rounded-2xl p-4 text-center">

                    <h3 class="text-3xl font-bold text-[#15633D]">
                        +12%
                    </h3>

                    <p class="text-[#717182] text-sm mt-1">
                        Growth
                    </p>

                </div>

            </div>


            <!-- INFO -->
            <div class="mt-8 space-y-4">

                <div>

                    <p class="text-[#717182] text-sm">
                        Ketua PAC
                    </p>

                    <h3 class="text-xl font-semibold">
                        {{ $pac->ketua }}
                    </h3>

                </div>

                <div>

                    <p class="text-[#717182] text-sm">
                        Telepon
                    </p>

                    <h3 class="text-xl">
                        {{ $pac->telepon }}
                    </h3>

                </div>

            </div>


            <!-- BUTTON -->
            <div class="grid grid-cols-2 gap-4 mt-8">

                <!-- DETAIL -->
                <button

                    data-nama="{{ $pac->nama_pac }}"
                    data-kecamatan="{{ $pac->kecamatan }}"
                    data-ketua="{{ $pac->ketua }}"
                    data-telepon="{{ $pac->telepon }}"

                    onclick="openDetailPACModal(this)"

                    class="border border-gray-200 rounded-2xl py-4 text-lg hover:bg-gray-50 transition"
                >

                    Detail

                </button>


                <!-- EDIT -->
                <button

                    data-id="{{ $pac->id }}"
                    data-nama="{{ $pac->nama_pac }}"
                    data-kecamatan="{{ $pac->kecamatan }}"
                    data-ketua="{{ $pac->ketua }}"
                    data-telepon="{{ $pac->telepon }}"

                    onclick="openEditPACModal(this)"

                    class="bg-[#15633D] text-white rounded-2xl py-4 text-lg hover:bg-[#0F5E3A] transition"
                >

                    Edit

                </button>

            </div>

        </div>

        @endforeach

    </div>

</div>


<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | CHART PAC
    |--------------------------------------------------------------------------
    */

    const pacDataEl = document.getElementById('pac-data');
    const labelsPAC = JSON.parse(pacDataEl.dataset.labels);
    const jumlahAnggotaPAC = JSON.parse(pacDataEl.dataset.jumlah);

    const statusCtx = document
        .getElementById('statusPacChart')
        .getContext('2d');

    new Chart(statusCtx, {

        type: 'bar',

        data: {

            labels: labelsPAC,

            datasets: [{

                label: 'Jumlah Anggota',

                data: jumlahAnggotaPAC,

                backgroundColor: '#15633D',

                borderRadius: 12

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | MODAL TAMBAH PAC
    |--------------------------------------------------------------------------
    */

    function openTambahPACModal()
    {
        document
            .getElementById('modalTambahPAC')
            .classList.remove('hidden');

        document
            .getElementById('modalTambahPAC')
            .classList.add('flex');
    }

    function closeTambahPACModal()
    {
        document
            .getElementById('modalTambahPAC')
            .classList.remove('flex');

        document
            .getElementById('modalTambahPAC')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | MODAL DETAIL PAC
    |--------------------------------------------------------------------------
    */

    function openDetailPACModal(button)
    {
        const nama = button.dataset.nama;
        const kecamatan = button.dataset.kecamatan;
        const ketua = button.dataset.ketua;
        const telepon = button.dataset.telepon;

        document
            .getElementById('modalDetailPAC')
            .classList.remove('hidden');

        document
            .getElementById('modalDetailPAC')
            .classList.add('flex');

        document.getElementById('detailNamaPAC').innerText = nama;
        document.getElementById('detailKecamatan').innerText = kecamatan;
        document.getElementById('detailKetua').innerText = ketua;
        document.getElementById('detailKontak').innerText = telepon;
    }

    function closeDetailPACModal()
    {
        document
            .getElementById('modalDetailPAC')
            .classList.remove('flex');

        document
            .getElementById('modalDetailPAC')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | MODAL EDIT PAC
    |--------------------------------------------------------------------------
    */

    function openEditPACModal(button)
    {
        const id = button.dataset.id;
        const nama = button.dataset.nama;
        const kecamatan = button.dataset.kecamatan;
        const ketua = button.dataset.ketua;
        const telepon = button.dataset.telepon;

        document
            .getElementById('modalEditPAC')
            .classList.remove('hidden');

        document
            .getElementById('modalEditPAC')
            .classList.add('flex');

        document.getElementById('editNamaPAC').value = nama;
        document.getElementById('editKecamatan').value = kecamatan;
        document.getElementById('editKetua').value = ketua;
        document.getElementById('editTelepon').value = telepon;

        document
            .getElementById('formEditPAC')
            .action = `/data-pac/update/${id}`;
    }

    function closeEditPACModal()
    {
        document
            .getElementById('modalEditPAC')
            .classList.remove('flex');

        document
            .getElementById('modalEditPAC')
            .classList.add('hidden');
    }

</script>


@include('partials.modalTambahPAC')
@include('partials.modalDetailPAC')
@include('partials.modalEditPAC')

@endsection