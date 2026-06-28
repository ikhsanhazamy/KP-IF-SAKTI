@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-[26px] font-bold text-gray-900 tracking-tight">
            Laporan & Analitik
        </h1>
        <p class="text-[#717182] mt-1 text-[14px] font-medium">
            Analisis data dan laporan organisasi Fatayat NU Sukabumi
        </p>
    </div>

    <!-- TOP REPORT CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- CARD 1 -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-xl bg-[#EDF7F0] flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#0F5E3A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6m10 0H7"/>
                    </svg>
                </div>
                <h2 class="text-[16px] font-bold text-gray-900 leading-tight">
                    Laporan Keanggotaan
                </h2>
                <p class="text-xs text-gray-400 mt-2 font-medium leading-relaxed">
                    Data lengkap anggota, statistik, dan demografi
                </p>
            </div>
            <a href="/laporan/export/pdf"
               class="mt-6 w-full border border-gray-200 hover:bg-gray-50 transition text-gray-700 py-2.5 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 shadow-sm bg-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v12m0 0l-4-4m4 4l4-4m5 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1"/>
                </svg>
                Generate PDF
            </a>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-xl bg-[#EDF7F0] flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#0F5E3A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="text-[16px] font-bold text-gray-900 leading-tight">
                    Laporan PAC
                </h2>
                <p class="text-xs text-gray-400 mt-2 font-medium leading-relaxed">
                    Ringkasan aktivitas dan kinerja kepengurusan PAC
                </p>
            </div>
            <button class="mt-6 w-full border border-gray-200 hover:bg-gray-50 transition text-gray-700 py-2.5 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 shadow-sm bg-white cursor-pointer">
                Generate Report
            </button>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-xl bg-[#EDF7F0] flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#0F5E3A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-[16px] font-bold text-gray-900 leading-tight">
                    Laporan Kegiatan
                </h2>
                <p class="text-xs text-gray-400 mt-2 font-medium leading-relaxed">
                    Daftar dan evaluasi kegiatan yang dilaksanakan
                </p>
            </div>
            <button class="mt-6 w-full border border-gray-200 hover:bg-gray-50 transition text-gray-700 py-2.5 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 shadow-sm bg-white cursor-pointer">
                Generate Report
            </button>
        </div>

    </div>
       
    <!-- CHART SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- LINE CHART -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <h2 class="text-[14px] font-bold text-gray-800 mb-6">
                Tren Pertumbuhan
            </h2>
            <div class="h-[260px]">
                <canvas id="growthChart"></canvas>
            </div>
        </div>

        <!-- PIE CHART -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <h2 class="text-[14px] font-bold text-gray-800 mb-6">
                Distribusi Profesi
            </h2>
            <div class="h-[260px] flex items-center justify-center">
                <canvas id="kegiatanChart"></canvas>
            </div>
        </div>

    </div>

    <!-- BOTTOM SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- BAR CHART -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <h2 class="text-[14px] font-bold text-gray-800 mb-6">
                Tingkat Pendidikan
            </h2>
            <div class="h-[260px]">
                <canvas id="pendidikanChart"></canvas>
            </div>
        </div>

        <!-- SUMMARY -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <h2 class="text-[14px] font-bold text-gray-800 mb-6">
                Ringkasan Statistik
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-400 font-medium">Rata-rata Usia Anggota</p>
                        <h3 class="text-lg font-bold text-gray-900 mt-1">34 tahun</h3>
                    </div>
                    <div class="text-[#0F5E3A]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-400 font-medium">Kegiatan per PAC</p>
                        <h3 class="text-lg font-bold text-gray-900 mt-1">18 kegiatan</h3>
                    </div>
                    <div class="text-[#0F5E3A]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-400 font-medium">Tingkat Partisipasi</p>
                        <h3 class="text-lg font-bold text-gray-900 mt-1">87%</h3>
                    </div>
                    <div class="text-[#0F5E3A]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-400 font-medium">PAC Teraktif</p>
                        <h3 class="text-lg font-bold text-gray-900 mt-1">Cibadak</h3>
                    </div>
                    <div class="text-[#0F5E3A]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- EXPORT DATA -->
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm mb-6">
        <h2 class="text-[14px] font-bold text-gray-800 mb-6">
            Export Data
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="/laporan/export/pdf"
               class="border border-gray-200 rounded-xl py-3 flex items-center justify-center hover:bg-gray-50 transition text-gray-700 text-xs font-semibold shadow-sm bg-white cursor-pointer">
                Export PDF
            </a>
            <a href="/laporan/export/excel"
               class="border border-gray-200 rounded-xl py-3 flex items-center justify-center hover:bg-gray-50 transition text-gray-700 text-xs font-semibold shadow-sm bg-white cursor-pointer">
                Export Excel
            </a>
            <a href="/laporan/export/csv"
               class="border border-gray-200 rounded-xl py-3 flex items-center justify-center hover:bg-gray-50 transition text-gray-700 text-xs font-semibold shadow-sm bg-white cursor-pointer">
                Export CSV
            </a>
        </div>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // LINE CHART
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
            datasets: [
                {
                    label: 'Anggota',
                    data: [2300, 2400, 2480, 2600, 2850],
                    borderColor: '#0F5E3A',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 3
                },
                {
                    label: 'Kegiatan',
                    data: [12, 14, 15, 16, 20],
                    borderColor: '#4FA36C',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11
                        }
                    }
                }
            },
            scales: {
                y: {
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11
                        }
                    }
                }
            }
        }
    });

    // PIE (DOUGHNUT) CHART
    const pieCtx = document.getElementById('kegiatanChart').getContext('2d');
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
                    '#0F5E3A',
                    '#2E7D55',
                    '#4FA36C',
                    '#83C49D',
                    '#D1EAD9'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 12,
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11
                        }
                    }
                }
            }
        }
    });

    // BAR CHART
    const pendidikanCtx = document.getElementById('pendidikanChart').getContext('2d');
    new Chart(pendidikanCtx, {
        type: 'bar',
        data: {
            labels: ['SMA', 'D3', 'S1', 'S2', 'S3'],
            datasets: [{
                data: [680, 560, 1280, 340, 30],
                backgroundColor: '#0F5E3A',
                borderRadius: 6,
                maxBarThickness: 16
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
            },
            scales: {
                x: {
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11
                        }
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9CA3AF',
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11
                        }
                    }
                }
            }
        }
    });

</script>

@endsection