@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-[26px] font-bold text-gray-900 tracking-tight">
                Manajemen PAC
            </h1>
            <p class="text-[#717182] mt-1 text-[14px] font-medium">
                Kelola data Pimpinan Anak Cabang se-Sukabumi
            </p>
        </div>
        <button
            onclick="openTambahPACModal()"
            class="bg-[#0F5E3A] hover:bg-[#0b4e30] transition text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-1.5 cursor-pointer shadow-sm"
        >
            <span class="text-lg leading-none">+</span>
            <span>Tambah PAC</span>
        </button>
    </div>

    <!-- STATISTIC -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-gray-900 leading-none">
                {{ $totalPAC }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                Total PAC
            </p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-[#0F5E3A] leading-none">
                {{ $pacAktif }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                PAC Aktif
            </p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-[#0F5E3A] leading-none">
                {{ number_format($totalAnggota) }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                Total Anggota
            </p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between h-[116px]">
            <h2 class="text-2xl font-bold text-gray-900 leading-none">
                {{ $totalKecamatan }}
            </h2>
            <p class="text-xs text-gray-400 font-medium">
                Kecamatan
            </p>
        </div>
    </div>

    <!-- CHART -->
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
        <h2 class="text-[14px] font-bold text-gray-800 mb-6">
            Distribusi Anggota per PAC
        </h2>
        <div class="h-[260px]">
            <canvas id="statusPacChart"></canvas>
            <div id="pac-data" class="hidden"
                 data-labels='@json($pacs->pluck("kecamatan")->values())'
                 data-jumlah='@json($pacs->pluck("jumlah_anggota")->values())'>
            </div>
        </div>
    </div>

    <!-- PAC GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pacs as $pac)
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-200">
            <!-- TOP -->
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-[16px] font-bold text-gray-900 leading-tight">
                        {{ $pac->nama_pac }}
                    </h2>
                    <p class="text-xs text-gray-400 mt-1 font-medium">
                        Kecamatan {{ $pac->kecamatan }}
                    </p>
                </div>
                @if($pac->status == 'aktif')
                    <span class="inline-flex items-center bg-[#eef3f0] text-[#0F5E3A] px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                        Aktif
                    </span>
                @else
                    <span class="inline-flex items-center bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                        Tidak Aktif
                    </span>
                @endif
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-3 gap-3 mt-6">
                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-3 text-center">
                    <h3 class="text-lg font-bold text-[#0F5E3A] leading-tight">
                        {{ $pac->jumlah_anggota }}
                    </h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">
                        Anggota
                    </p>
                </div>

                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-3 text-center">
                    <h3 class="text-lg font-bold text-[#0F5E3A] leading-tight">
                        {{ $pac->total_kegiatan ?? 0 }}
                    </h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">
                        Kegiatan
                    </p>
                </div>

                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-3 text-center">
                    <h3 class="text-lg font-bold text-[#0F5E3A] leading-tight">
                        +8%
                    </h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">
                        Growth
                    </p>
                </div>
            </div>

            <!-- INFO -->
            <div class="mt-6 space-y-3 pt-4 border-t border-gray-50">
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                        Ketua PAC
                    </p>
                    <h3 class="text-[13px] font-semibold text-gray-800 mt-0.5">
                        {{ $pac->ketua_pac }}
                    </h3>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                        Telepon
                    </p>
                    <h3 class="text-[13px] font-semibold text-gray-800 mt-0.5">
                        {{ $pac->telepon }}
                    </h3>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="grid grid-cols-2 gap-3 mt-6 border-t border-gray-50 pt-4">
                <!-- DETAIL -->
                <button
                    data-nama="{{ $pac->nama_pac }}"
                    data-kecamatan="{{ $pac->kecamatan }}"
                    data-ketua="{{ $pac->ketua_pac }}"
                    data-telepon="{{ $pac->telepon }}"
                    data-nomor-sk="{{ $pac->nomor_sk }}"
                    data-jumlah-anggota="{{ $pac->jumlah_anggota }}"
                    data-pertumbuhan="+8%"
                    data-total-kegiatan="{{ $pac->total_kegiatan ?? 0 }}"
                    onclick="openDetailPACModal(this)"
                    class="border border-gray-200 hover:bg-gray-50 transition text-gray-700 py-2.5 rounded-xl text-xs font-semibold text-center cursor-pointer bg-white"
                >
                    Detail
                </button>

                <!-- EDIT -->
                <button
                    data-id="{{ $pac->id }}"
                    data-nama="{{ $pac->nama_pac }}"
                    data-kecamatan="{{ $pac->kecamatan }}"
                    data-status="{{ $pac->status }}"
                    data-tanggal-berdiri="{{ $pac->tanggal_berdiri }}"
                    data-alamat="{{ $pac->alamat }}"
                    data-desa="{{ $pac->desa }}"
                    data-kode-pos="{{ $pac->kode_pos }}"
                    data-ketua="{{ $pac->ketua_pac }}"
                    data-telepon="{{ $pac->telepon }}"
                    data-email="{{ $pac->email }}"
                    data-nomor-sk="{{ $pac->nomor_sk }}"
                    data-jumlah-anggota="{{ $pac->jumlah_anggota }}"
                    data-total-kegiatan="{{ $pac->total_kegiatan ?? 0 }}"
                    data-deskripsi="{{ $pac->deskripsi }}"
                    onclick="openEditPACModal(this)"
                    class="bg-[#0F5E3A] hover:bg-[#0b4e30] transition text-white py-2.5 rounded-xl text-xs font-bold text-center cursor-pointer shadow-sm"
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

    const statusCtx = document.getElementById('statusPacChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: labelsPAC,
            datasets: [{
                label: 'Jumlah Anggota',
                data: jumlahAnggotaPAC,
                backgroundColor: '#0F5E3A',
                borderRadius: 6,
                maxBarThickness: 32
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
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
        const nomorSK = button.dataset.nomorSk;
        const jumlahAnggota = button.dataset.jumlahAnggota;
        const pertumbuhan = button.dataset.pertumbuhan;
        const totalKegiatan = button.dataset.totalKegiatan;

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
        document.getElementById('detailNomorSK').innerText = nomorSK || '-';
        document.getElementById('detailJumlahAnggota').innerText = jumlahAnggota || '0';
        document.getElementById('detailPertumbuhan').innerText = pertumbuhan || '+0%';
        document.getElementById('detailTotalKegiatan').innerText = totalKegiatan || '0';
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
        const status = button.dataset.status;
        const tanggalBerdiri = button.dataset.tanggalBerdiri;
        const alamat = button.dataset.alamat;
        const desa = button.dataset.desa;
        const kodePos = button.dataset.kodePos;
        const ketua = button.dataset.ketua;
        const telepon = button.dataset.telepon;
        const email = button.dataset.email;
        const nomorSK = button.dataset.nomorSk;
        const jumlahAnggota = button.dataset.jumlahAnggota;
        const totalKegiatan = button.dataset.totalKegiatan;
        const deskripsi = button.dataset.deskripsi;

        document
            .getElementById('modalEditPAC')
            .classList.remove('hidden');

        document
            .getElementById('modalEditPAC')
            .classList.add('flex');

        document.getElementById('editNamaPAC').value = nama || '';
        document.getElementById('editKecamatan').value = kecamatan || '';
        document.getElementById('editStatus').value = status || 'aktif';
        document.getElementById('editTanggalBerdiri').value = tanggalBerdiri || '';
        document.getElementById('editAlamat').value = alamat || '';
        document.getElementById('editDesa').value = desa || '';
        document.getElementById('editKodePos').value = kodePos || '';
        document.getElementById('editKetua').value = ketua || '';
        document.getElementById('editTelepon').value = telepon || '';
        document.getElementById('editEmail').value = email || '';
        document.getElementById('editNomorSK').value = nomorSK || '';
        document.getElementById('editJumlahAnggota').value = jumlahAnggota || 0;
        document.getElementById('editTotalKegiatan').value = totalKegiatan || 0;
        document.getElementById('editDeskripsi').value = deskripsi || '';

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