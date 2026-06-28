@extends('layouts.app')

@section('content')
<div class="space-y-7">
    <div>
        <h1 class="text-4xl font-bold text-gray-900">Laporan & Analitik</h1>
        <p class="mt-2 text-lg text-gray-500">Analisis data dan laporan organisasi Fatayat NU Sukabumi</p>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @php
            $reportCards = [
                [
                    'title' => 'Laporan Keanggotaan',
                    'description' => 'Data lengkap anggota, statistik, dan demografi',
                    'url' => '/laporan/generate/anggota',
                    'icon' => 'members',
                    'total' => $totalAnggota.' anggota',
                ],
                [
                    'title' => 'Laporan PAC',
                    'description' => 'Ringkasan aktivitas dan kinerja PAC',
                    'url' => '/laporan/generate/pac',
                    'icon' => 'building',
                    'total' => $totalPAC.' PAC',
                ],
                [
                    'title' => 'Laporan Kegiatan',
                    'description' => 'Daftar dan evaluasi kegiatan yang dilaksanakan',
                    'url' => '/laporan/generate/kegiatan',
                    'icon' => 'calendar',
                    'total' => $totalKegiatan.' kegiatan',
                ],
            ];
        @endphp

        @foreach($reportCards as $card)
            <div class="rounded-3xl border border-gray-200 bg-white p-7">
                <div class="mb-5 flex items-start justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#EDF7F0] text-[#15633D]">
                        @if($card['icon'] === 'members')
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 20v-1.5A3.5 3.5 0 0 0 12.5 15h-5A3.5 3.5 0 0 0 4 18.5V20m15.5 0v-1a3 3 0 0 0-2.5-2.96M12.5 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm3-2.7a3.2 3.2 0 0 1 0 6.4"/>
                            </svg>
                        @elseif($card['icon'] === 'building')
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 21h16M6 21V6a2 2 0 0 1 2-2h6v17m0-12h4a1 1 0 0 1 1 1v11M9 8h2m-2 4h2m-2 4h2m6-3h-1m1 4h-1"/>
                            </svg>
                        @else
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 3v4m10-4v4M4 9h16M6 5h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                            </svg>
                        @endif
                    </div>
                    <span class="rounded-full bg-[#F3F7F4] px-3 py-1 text-sm font-medium text-[#15633D]">
                        {{ $card['total'] }}
                    </span>
                </div>

                <h2 class="text-xl font-bold text-gray-900">{{ $card['title'] }}</h2>
                <p class="mt-3 min-h-12 text-gray-500">{{ $card['description'] }}</p>
                <a href="{{ $card['url'] }}" class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl border border-gray-200 py-3 hover:bg-gray-50">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v12m0 0-4-4m4 4 4-4M5 17v2a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2"/>
                    </svg>
                    Generate
                </a>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
        <div class="rounded-3xl border border-gray-200 bg-white p-7">
            <h2 class="mb-6 text-2xl font-bold">Tren Pertumbuhan</h2>
            <div class="h-[320px]"><canvas id="growthChart"></canvas></div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-7">
            <h2 class="mb-6 text-2xl font-bold">Distribusi Profesi</h2>
            <div class="h-[320px]"><canvas id="professionChart"></canvas></div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
        <div class="rounded-3xl border border-gray-200 bg-white p-7">
            <h2 class="mb-6 text-2xl font-bold">Tingkat Pendidikan</h2>
            <div class="h-[360px]"><canvas id="educationChart"></canvas></div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-7">
            <h2 class="mb-6 text-2xl font-bold">Ringkasan Statistik</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between rounded-2xl bg-[#F8FAF9] p-5">
                    <div>
                        <p class="text-gray-500">Rata-rata Usia Anggota</p>
                        <h3 class="mt-1 text-3xl font-bold">{{ $averageAge }} tahun</h3>
                    </div>
                    <svg class="h-9 w-9 text-[#199451]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 20v-1.5A3.5 3.5 0 0 0 12.5 15h-5A3.5 3.5 0 0 0 4 18.5V20m15.5 0v-1a3 3 0 0 0-2.5-2.96M12.5 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm3-2.7a3.2 3.2 0 0 1 0 6.4"/>
                    </svg>
                </div>

                <div class="flex items-center justify-between rounded-2xl bg-[#F8FAF9] p-5">
                    <div>
                        <p class="text-gray-500">Kegiatan per PAC (rata-rata)</p>
                        <h3 class="mt-1 text-3xl font-bold">{{ number_format($averageActivitiesPerPac, 1, ',', '.') }} kegiatan</h3>
                    </div>
                    <svg class="h-9 w-9 text-[#49AA6C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 3v4m10-4v4M4 9h16M6 5h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                    </svg>
                </div>

                <div class="flex items-center justify-between rounded-2xl bg-[#F8FAF9] p-5">
                    <div>
                        <p class="text-gray-500">Tingkat Partisipasi</p>
                        <h3 class="mt-1 text-3xl font-bold">{{ $participationRate }}%</h3>
                    </div>
                    <svg class="h-9 w-9 text-[#16884A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4 17 5-5 4 4 7-8m0 0h-5m5 0v5"/>
                    </svg>
                </div>

                <div class="flex items-center justify-between rounded-2xl bg-[#F8FAF9] p-5">
                    <div>
                        <p class="text-gray-500">PAC Teraktif</p>
                        <h3 class="mt-1 text-2xl font-bold">{{ $mostActivePac }}</h3>
                    </div>
                    <svg class="h-9 w-9 text-[#49AA6C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 21h16M6 21V6a2 2 0 0 1 2-2h6v17m0-12h4a1 1 0 0 1 1 1v11M9 8h2m-2 4h2m-2 4h2m6-3h-1m1 4h-1"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-7">
        <h2 class="mb-6 text-2xl font-bold">Export Data Anggota</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach([
                ['/laporan/export/pdf', 'Export ke PDF'],
                ['/laporan/export/excel', 'Export ke Excel'],
                ['/laporan/export/csv', 'Export ke CSV'],
            ] as [$url, $label])
                <a href="{{ $url }}" class="flex items-center justify-center gap-2 rounded-2xl border border-gray-200 py-4 hover:bg-gray-50">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v12m0 0-4-4m4 4 4-4M5 17v2a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2"/>
                    </svg>
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const gridColor = '#E9EEEB';
        const labelColor = '#87909E';
        const professionLabels = @json($professionLabels);
        const professionValues = @json($professionValues);
        const hasProfessionData = professionValues.some(value => Number(value) > 0);

        new Chart(document.getElementById('growthChart'), {
            type: 'line',
            data: {
                labels: @json($growthLabels),
                datasets: [
                    {
                        label: 'Anggota',
                        data: @json($memberGrowth),
                        borderColor: '#15633D',
                        backgroundColor: '#15633D',
                        tension: 0.35,
                        borderWidth: 2.5,
                        pointRadius: 3,
                    },
                    {
                        label: 'Kegiatan',
                        data: @json($activityGrowth),
                        borderColor: '#61B87C',
                        backgroundColor: '#61B87C',
                        tension: 0.35,
                        borderWidth: 2.5,
                        pointRadius: 3,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { grid: { color: gridColor }, ticks: { color: labelColor } },
                    y: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: labelColor, precision: 0 } },
                },
                plugins: { legend: { labels: { usePointStyle: true } } },
            },
        });

        new Chart(document.getElementById('professionChart'), {
            type: 'pie',
            data: {
                labels: hasProfessionData ? professionLabels : ['Belum ada data'],
                datasets: [{
                    data: hasProfessionData ? professionValues : [1],
                    backgroundColor: hasProfessionData
                        ? ['#12633B', '#4FA86B', '#83BF92', '#B8D9C1', '#D7E9DD', '#2D7E4E', '#9CCCAA']
                        : ['#E5E7EB'],
                    borderColor: '#FFFFFF',
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right', labels: { boxWidth: 12, usePointStyle: true } } },
            },
        });

        new Chart(document.getElementById('educationChart'), {
            type: 'bar',
            data: {
                labels: @json($educationLabels),
                datasets: [{
                    data: @json($educationValues),
                    backgroundColor: '#15633D',
                    borderRadius: 8,
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: labelColor, precision: 0 } },
                    y: { grid: { display: false }, ticks: { color: labelColor } },
                },
                plugins: { legend: { display: false } },
            },
        });
    });
</script>
@endsection
