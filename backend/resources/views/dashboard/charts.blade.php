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

    new Chart(
        document.getElementById('pendidikanChart'),
        {
            type: 'line',
            data: {
                labels: pendidikanLabels,
                datasets: [{
                    data: pendidikanData,
                    borderColor: '#15633D',
                    backgroundColor: 'rgba(21,99,61,0.10)',
                    fill: true
                }]
            }
        }
    );

    new Chart(
        document.getElementById('profesiChart'),
        {
            type: 'bar',
            data: {
                labels: profesiLabels,
                datasets: [{
                    data: profesiData,
                    backgroundColor: '#15633D'
                }]
            }
        }
    );

    new Chart(
        document.getElementById('pacChart'),
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
                        '#15633D',
                        '#DDE9E1'
                    ]
                }]
            }
        }
    );

});

</script>