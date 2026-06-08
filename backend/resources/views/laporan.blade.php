@extends('layouts.app')

@section('content')

<main class="flex-1 bg-[#F5F7F6] p-7 overflow-y-auto">

    <div class="space-y-7">

        <!-- HEADER -->
        <div>

            <h1 class="text-4xl font-bold text-gray-900">
                Laporan & Analitik
            </h1>

            <p class="text-gray-500 mt-2 text-lg">
                Analisis data dan laporan organisasi Fatayat NU Sukabumi
            </p>

        </div>

        <!-- TOP REPORT CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- CARD -->
            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <div class="w-14 h-14 rounded-2xl bg-[#EDF7F0] flex items-center justify-center mb-5">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-7 h-7 text-[#15633D]"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5V4H2v16h5m10 0v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6m10 0H7"/>

                    </svg>

                </div>

                <h2 class="text-2xl font-bold text-gray-900">
                    Laporan Keanggotaan
                </h2>

                <p class="text-gray-500 mt-3 leading-relaxed">
                    Data lengkap anggota, statistik, dan demografi
                </p>

                <a href="/laporan/export/pdf"
                   class="mt-7 w-full border border-gray-200 rounded-2xl py-3 flex items-center justify-center gap-3 hover:bg-gray-50 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 4v12m0 0l-4-4m4 4l4-4m5 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1"/>

                    </svg>

                    Generate

                </a>

            </div>

            <!-- CARD -->
            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <div class="w-14 h-14 rounded-2xl bg-[#EDF7F0] flex items-center justify-center mb-5">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-7 h-7 text-[#15633D]"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                    </svg>

                </div>

                <h2 class="text-2xl font-bold">
                    Laporan PAC
                </h2>

                <p class="text-gray-500 mt-3">
                    Ringkasan aktivitas dan kinerja PAC
                </p>

                <button class="mt-7 w-full border border-gray-200 rounded-2xl py-3 hover:bg-gray-50 transition">
                    Generate
                </button>

            </div>

            <!-- CARD -->
            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <div class="w-14 h-14 rounded-2xl bg-[#EDF7F0] flex items-center justify-center mb-5">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-7 h-7 text-[#15633D]"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>

                    </svg>

                </div>

                <h2 class="text-2xl font-bold">
                    Laporan Kegiatan
                </h2>

                <p class="text-gray-500 mt-3">
                    Daftar dan evaluasi kegiatan yang dilaksanakan
                </p>

                <button class="mt-7 w-full border border-gray-200 rounded-2xl py-3 hover:bg-gray-50 transition">
                    Generate
                </button>

            </div>

        </div>
           
        <!-- CHART SECTION -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <!-- LINE CHART -->
            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <h2 class="text-2xl font-bold mb-6">
                    Tren Pertumbuhan
                </h2>

                <div class="h-[320px]">

                    <canvas id="growthChart"></canvas>

                </div>

            </div>

            <!-- PIE CHART -->
            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <h2 class="text-2xl font-bold mb-6">
                    Distribusi Profesi
                </h2>

                <div class="h-[320px] flex items-center justify-center">

                    <canvas id="kegiatanChart"></canvas>

                </div>

            </div>

        </div>

        <!-- BOTTOM SECTION -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <!-- BAR CHART -->
            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <h2 class="text-2xl font-bold mb-6">
                    Tingkat Pendidikan
                </h2>

                <div class="h-[320px]">

                    <canvas id="pendidikanChart"></canvas>

                </div>

            </div>

            <!-- SUMMARY -->
            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <h2 class="text-2xl font-bold mb-6">
                    Ringkasan Statistik
                </h2>

                <div class="space-y-4">

                    <div class="bg-[#F8FAF9] rounded-2xl p-5 flex justify-between items-center">

                        <div>

                            <p class="text-gray-500">
                                Rata-rata Usia Anggota
                            </p>

                            <h3 class="text-4xl font-bold mt-1">
                                34 tahun
                            </h3>

                        </div>

                        <div class="text-[#15633D] text-4xl">
                            👥
                        </div>

                    </div>

                    <div class="bg-[#F8FAF9] rounded-2xl p-5 flex justify-between items-center">

                        <div>

                            <p class="text-gray-500">
                                Kegiatan per PAC
                            </p>

                            <h3 class="text-4xl font-bold mt-1">
                                18 kegiatan
                            </h3>

                        </div>

                        <div class="text-[#15633D] text-4xl">
                            📅
                        </div>

                    </div>

                    <div class="bg-[#F8FAF9] rounded-2xl p-5 flex justify-between items-center">

                        <div>

                            <p class="text-gray-500">
                                Tingkat Partisipasi
                            </p>

                            <h3 class="text-4xl font-bold mt-1">
                                87%
                            </h3>

                        </div>

                        <div class="text-[#15633D] text-4xl">
                            📈
                        </div>

                    </div>

                    <div class="bg-[#F8FAF9] rounded-2xl p-5 flex justify-between items-center">

                        <div>

                            <p class="text-gray-500">
                                PAC Teraktif
                            </p>

                            <h3 class="text-3xl font-bold mt-1">
                                PAC Cibadak
                            </h3>

                        </div>

                        <div class="text-[#15633D] text-4xl">
                            🏢
                        </div>

                    </div>

                </div>

            </div>

        </div>

       <!-- EXPORT DATA -->
        <div class="bg-white border border-gray-200 rounded-3xl p-7">

            <h2 class="text-2xl font-bold mb-6">
                Export Data
            </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <a
                href="/laporan/export/pdf"
                class="border border-gray-200 rounded-2xl py-4 flex items-center justify-center hover:bg-gray-50 transition"
            >
                Export PDF
            </a>

            <a
                href="/laporan/export/excel"
                class="border border-gray-200 rounded-2xl py-4 flex items-center justify-center hover:bg-gray-50 transition"
            >
                Export Excel
            </a>

            <a
                href="/laporan/export/csv"
                class="border border-gray-200 rounded-2xl py-4 flex items-center justify-center hover:bg-gray-50 transition"
            >
                Export CSV
            </a>

        </div>

    </div>

</main>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // LINE CHART
    const growthCtx = document
        .getElementById('growthChart')
        .getContext('2d');

    new Chart(growthCtx, {

        type: 'line',

        data: {

            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],

            datasets: [

                {
                    label: 'Anggota',
                    data: [2300, 2400, 2480, 2600, 2850],
                    borderColor: '#15633D',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 3
                },

                {
                    label: 'Kegiatan',
                    data: [12, 14, 15, 16, 20],
                    borderColor: '#8CC7A1',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 3
                }

            ]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false

        }

    });

    // PIE CHART
    const pieCtx = document
        .getElementById('kegiatanChart')
        .getContext('2d');

    new Chart(pieCtx, {

        type: 'doughnut',

        data: {

            labels: [
                'Guru/Dosen',
                'Pengusaha',
                'PNS',
                'Pegawai Swasta',
                'Lainnya'
            ],

            datasets: [{

                data: [845, 623, 467, 512, 400],

                backgroundColor: [
                    '#1E5631',
                    '#4E8F5A',
                    '#6DB27C',
                    '#CFE3D5',
                    '#8DC69B'
                ],

                borderWidth: 0

            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false

        }

    });

    // BAR CHART
    const pendidikanCtx = document
        .getElementById('pendidikanChart')
        .getContext('2d');

    new Chart(pendidikanCtx, {

        type: 'bar',

        data: {

            labels: ['SMA', 'D3', 'S1', 'S2', 'S3'],

            datasets: [{

                data: [680, 560, 1280, 340, 30],

                backgroundColor: '#15633D',
                borderRadius: 10

            }]

        },

        options: {

            indexAxis: 'y',

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });

</script>

@endsection