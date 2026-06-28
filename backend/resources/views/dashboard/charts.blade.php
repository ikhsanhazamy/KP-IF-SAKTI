<script>

const pendidikanLabels =
@json($pendidikanChart->pluck('pendidikan')->values()->all());

const pendidikanData =
@json($pendidikanChart->pluck('total')->values()->all());

const profesiLabels =
@json($profesiChart->pluck('profesi')->values()->all());

const profesiData =
@json($profesiChart->pluck('total')->values()->all());

const pacAktif =
{{ $pacAktif }};

const pacTidakAktif =
{{ $pacTidakAktif }};

document.addEventListener('DOMContentLoaded', function () {

    // 1. Pendidikan Chart (Area Line)
    const pendidikanCtx = document.getElementById('pendidikanChart').getContext('2d');
    const gradient = pendidikanCtx.createLinearGradient(0, 0, 0, 240);
    gradient.addColorStop(0, 'rgba(15, 94, 58, 0.16)');
    gradient.addColorStop(1, 'rgba(15, 94, 58, 0.00)');

    new Chart(
        pendidikanCtx,
        {
            type: 'line',
            data: {
                labels: pendidikanLabels,
                datasets: [{
                    data: pendidikanData,
                    borderColor: '#0F5E3A',
                    borderWidth: 2.5,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    pointHoverBackgroundColor: '#0F5E3A',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        padding: 10,
                        bodyFont: { family: 'Plus Jakarta Sans', size: 11, weight: '500' },
                        titleFont: { family: 'Plus Jakarta Sans', size: 11, weight: '700' },
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            color: '#717182',
                            font: { family: 'Plus Jakarta Sans', size: 10, weight: '500' }
                        }
                    },
                    y: {
                        grid: {
                            color: '#F3F4F6',
                            tickBorderDash: [4, 4],
                            drawTicks: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            color: '#717182',
                            font: { family: 'Plus Jakarta Sans', size: 10, weight: '500' }
                        }
                    }
                }
            }
        }
    );

    // 2. Profesi Chart (Bar)
    const profesiCtx = document.getElementById('profesiChart').getContext('2d');
    new Chart(
        profesiCtx,
        {
            type: 'bar',
            data: {
                labels: profesiLabels,
                datasets: [{
                    data: profesiData,
                    backgroundColor: '#0F5E3A',
                    borderRadius: { topLeft: 6, topRight: 6, bottomLeft: 0, bottomRight: 0 },
                    borderSkipped: false,
                    maxBarThickness: 32
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        padding: 10,
                        bodyFont: { family: 'Plus Jakarta Sans', size: 11, weight: '500' },
                        titleFont: { family: 'Plus Jakarta Sans', size: 11, weight: '700' },
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            color: '#717182',
                            font: { family: 'Plus Jakarta Sans', size: 10, weight: '500' }
                        }
                    },
                    y: {
                        grid: {
                            color: '#F3F4F6',
                            tickBorderDash: [4, 4],
                            drawTicks: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            color: '#717182',
                            font: { family: 'Plus Jakarta Sans', size: 10, weight: '500' }
                        }
                    }
                }
            }
        }
    );

    // 3. Status PAC Chart (Doughnut)
    const pacCtx = document.getElementById('pacChart').getContext('2d');
    new Chart(
        pacCtx,
        {
            type: 'doughnut',
            data: {
                labels: [
                    'PAC Aktif',
                    'PAC Tidak Aktif'
                ],
                datasets: [{
                    data: [
                        pacAktif,
                        pacTidakAktif
                    ],
                    backgroundColor: [
                        '#0F5E3A',
                        '#DDE9E1'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        padding: 10,
                        bodyFont: { family: 'Plus Jakarta Sans', size: 11, weight: '500' },
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        cornerRadius: 8
                    }
                }
            }
        }
    );

});

</script>