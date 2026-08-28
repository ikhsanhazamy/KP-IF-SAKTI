<script>
document.addEventListener('DOMContentLoaded', () => {
    const textColor = '#8A8F9D';
    const gridColor = '#E9EEEB';
    const anggotaCanvas = document.getElementById('anggotaGrowthChart');
    const anggotaContext = anggotaCanvas.getContext('2d');
    const anggotaGradient = anggotaContext.createLinearGradient(0, 0, 0, 260);

    anggotaGradient.addColorStop(0, 'rgba(79, 163, 108, 0.35)');
    anggotaGradient.addColorStop(1, 'rgba(79, 163, 108, 0.03)');

    new Chart(anggotaCanvas, {
        type: 'line',
        data: {
            labels: @json($anggotaGrowthChart->pluck('label')->all()),
            datasets: [{
                data: @json($anggotaGrowthChart->pluck('total')->all()),
                borderColor: '#287A50',
                backgroundColor: anggotaGradient,
                borderWidth: 2,
                pointRadius: 0,
                pointHoverRadius: 4,
                pointHoverBackgroundColor: '#287A50',
                tension: 0.35,
                fill: true,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: {
                legend: { display: false },
            },
            scales: {
                x: {
                    grid: { color: gridColor, borderDash: [4, 4] },
                    ticks: { color: textColor, font: { size: 11 } },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor, borderDash: [4, 4] },
                    ticks: { color: textColor, precision: 0, font: { size: 11 } },
                },
            },
        },
    });

    new Chart(document.getElementById('profesiChart'), {
        type: 'bar',
        data: {
            labels: @json($profesiChart->pluck('profesi')->values()->all()),
            datasets: [{
                data: @json($profesiChart->pluck('total')->values()->all()),
                backgroundColor: '#4FA36C',
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 54,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: textColor, font: { size: 11 } },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor, borderDash: [4, 4] },
                    ticks: { color: textColor, precision: 0, font: { size: 11 } },
                },
            },
        },
    });

    new Chart(document.getElementById('pacChart'), {
        type: 'doughnut',
        data: {
            labels: ['PAC Aktif', 'PAC Tidak Aktif'],
            datasets: [{
                data: [{{ $pacAktif }}, {{ $pacTidakAktif }}],
                backgroundColor: ['#4FA36C', '#DCECE3'],
                borderColor: '#FFFFFF',
                borderWidth: 4,
                hoverOffset: 2,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { display: false },
            },
        },
    });
});
</script>
