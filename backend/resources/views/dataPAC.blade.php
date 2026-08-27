@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-[1600px] space-y-7">
    @if(session('success'))
        <div class="rounded-2xl bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-2xl bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-semibold">PAC belum dapat disimpan:</p>
            <ul class="mt-2 list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-[30px] font-bold tracking-[-0.03em] text-[#202321] sm:text-[34px]">
                Manajemen PAC
            </h1>
            <p class="mt-2 text-[15px] text-[#747887] sm:text-base">
                Kelola data Pimpinan Anak Cabang se-Sukabumi
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <form action="{{ route('pac.import-csv') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                @csrf
                <label class="inline-flex h-12 cursor-pointer items-center justify-center rounded-2xl border border-[#DFE4E1] bg-white px-5 text-sm font-semibold text-[#262926] transition hover:bg-[#F7F9F8]">
                    Import CSV
                    <input type="file" name="csv_file" accept=".csv,text/csv" class="hidden" onchange="this.form.submit()">
                </label>
            </form>

            <a
                href="{{ route('pac.export-excel') }}"
                class="inline-flex h-12 items-center justify-center gap-2 rounded-2xl border border-[#DFE4E1] bg-white px-5 text-sm font-semibold text-[#262926] transition hover:bg-[#F7F9F8]"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 3v12"></path>
                    <path d="m7 10 5 5 5-5"></path>
                    <path d="M5 21h14"></path>
                </svg>
                Export Excel
            </a>

            <button
                type="button"
                onclick="openTambahPACModal()"
                class="inline-flex h-12 items-center justify-center gap-2 rounded-2xl bg-[#176B43] px-6 text-sm font-semibold text-white transition hover:bg-[#0F5534]"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M12 5v14M5 12h14"></path>
                </svg>
                Tambah PAC
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $summaryCards = [
                ['value' => $totalPAC, 'label' => 'Total PAC', 'color' => 'text-[#202321]'],
                ['value' => $pacAktif, 'label' => 'PAC Aktif', 'color' => 'text-[#4FA36C]'],
                ['value' => $totalAnggota, 'label' => 'Total Anggota', 'color' => 'text-[#176B43]'],
                ['value' => $totalKecamatan, 'label' => 'Kecamatan', 'color' => 'text-[#202321]'],
            ];
        @endphp

        @foreach($summaryCards as $card)
            <article class="rounded-[18px] border border-[#E2E6E3] bg-white px-6 py-5">
                <h2 class="{{ $card['color'] }} text-[30px] font-bold tracking-[-0.03em]">
                    {{ number_format($card['value']) }}
                </h2>
                <p class="mt-1 text-sm text-[#747887]">{{ $card['label'] }}</p>
            </article>
        @endforeach
    </div>

    <section class="rounded-[18px] border border-[#E2E6E3] bg-white p-6 sm:p-7">
        <h2 class="text-lg font-bold text-[#202321]">Distribusi Anggota per PAC</h2>
        <div class="mt-6 h-[300px] sm:h-[340px]">
            <canvas
                id="statusPacChart"
                data-labels="{{ $chartPACs->pluck('kecamatan')->values()->toJson() }}"
                data-values="{{ $chartPACs->pluck('jumlah_anggota')->values()->toJson() }}"
            ></canvas>
        </div>
    </section>

    <div class="flex items-center justify-between gap-4">
        <h2 class="text-lg font-bold text-[#202321]">Daftar PAC</h2>
        <p class="text-sm text-[#747887]">
            Menampilkan {{ $pacs->firstItem() ?? 0 }}-{{ $pacs->lastItem() ?? 0 }} dari {{ $pacs->total() }} PAC
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse($pacs as $pac)
            @php
                $statusMeta = match ($pac->status) {
                    'aktif' => ['label' => 'Aktif', 'class' => 'bg-[#EEF7F1] text-[#4FA36C]'],
                    'akan_expire' => ['label' => 'Akan Expire', 'class' => 'bg-amber-50 text-amber-600'],
                    'pending' => ['label' => 'Pending / Verifikasi', 'class' => 'bg-yellow-100 text-yellow-800'],
                    default => ['label' => 'Tidak Aktif', 'class' => 'bg-[#F2F4F3] text-[#747887]'],
                };
                $growthPositive = $pac->growth > 0;
                $growthNegative = $pac->growth < 0;
                $growthColor = $growthPositive
                    ? 'text-[#4FA36C]'
                    : ($growthNegative ? 'text-[#747887]' : 'text-[#176B43]');
            @endphp

            <article id="pac-{{ $pac->id }}" class="flex min-h-[430px] scroll-mt-6 flex-col rounded-[18px] border border-[#E2E6E3] bg-white p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <h2 class="truncate text-xl font-bold tracking-[-0.02em] text-[#202321]">
                            {{ $pac->nama_pac }}
                        </h2>
                        <p class="mt-2 flex items-center gap-2 text-sm text-[#747887]">
                            <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="2.5"></circle>
                            </svg>
                            Kecamatan {{ $pac->kecamatan }}
                        </p>
                    </div>

                    <span class="{{ $statusMeta['class'] }} shrink-0 rounded-full px-3 py-1.5 text-xs font-medium">
                        {{ $statusMeta['label'] }}
                    </span>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div class="rounded-2xl bg-[#F8FAF9] px-2 py-4 text-center">
                        <svg class="mx-auto h-6 w-6 text-[#176B43]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="9" cy="7" r="3"></circle>
                            <path d="M3.5 20v-1.5A4.5 4.5 0 0 1 8 14h2a4.5 4.5 0 0 1 4.5 4.5V20M16 4.5a3 3 0 0 1 0 5.8M17.5 14.2a4.5 4.5 0 0 1 3 4.3V20"></path>
                        </svg>
                        <h3 class="mt-2 text-xl font-bold text-[#202321]">{{ number_format($pac->jumlah_anggota) }}</h3>
                        <p class="mt-1 text-xs text-[#747887]">Anggota</p>
                    </div>

                    <div class="rounded-2xl bg-[#F8FAF9] px-2 py-4 text-center">
                        <svg class="mx-auto h-6 w-6 text-[#4FA36C]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 12h4l2-7 4 14 2-7h6"></path>
                        </svg>
                        <h3 class="mt-2 text-xl font-bold text-[#202321]">{{ number_format($pac->alumni_lkd) }}</h3>
                        <p class="mt-1 text-xs text-[#747887]">Alumni LKD</p>
                    </div>

                    <div class="rounded-2xl bg-[#F8FAF9] px-2 py-4 text-center">
                        <svg class="{{ $growthColor }} mx-auto h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            @if($pac->growth === 0)
                                <path d="M5 12h14"></path>
                            @elseif($growthNegative)
                                <path d="m5 7 5 5 4-4 5 5M19 13v-5h-5"></path>
                            @else
                                <path d="m5 17 5-5 4 4 5-5M14 11h5v5"></path>
                            @endif
                        </svg>
                        <h3 class="{{ $growthColor }} mt-2 text-xl font-bold">
                            {{ $pac->growth > 0 ? '+' : '' }}{{ $pac->growth }}%
                        </h3>
                        <p class="mt-1 text-xs text-[#747887]">Growth</p>
                    </div>
                </div>

                <div class="my-6 h-px bg-[#E9ECEA]"></div>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-[#8A8F9D]">Ketua PAC</p>
                        <h3 class="mt-1 truncate text-sm font-semibold text-[#262926]">
                            {{ $pac->ketua_pac ?: '-' }}
                        </h3>
                    </div>
                    <div>
                        <p class="text-xs text-[#8A8F9D]">Kontak</p>
                        <h3 class="mt-1 text-sm text-[#262926]">{{ $pac->telepon ?: '-' }}</h3>
                    </div>
                </div>

                <div class="mt-auto grid grid-cols-2 gap-3 pt-6">
                    <button
                        type="button"
                        data-nama="{{ $pac->nama_pac }}"
                        data-kecamatan="{{ $pac->kecamatan }}"
                        data-ketua="{{ $pac->ketua_pac }}"
                        data-telepon="{{ $pac->telepon }}"
                        data-nomor-sk="{{ $pac->nomor_sk }}"
                        data-jumlah-anggota="{{ $pac->jumlah_anggota }}"
                        data-pertumbuhan="{{ $pac->growth > 0 ? '+' : '' }}{{ $pac->growth }}%"
                        data-alumni-lkd="{{ $pac->alumni_lkd }}"
                        onclick="openDetailPACModal(this)"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-[#DFE4E1] text-sm font-medium text-[#262926] transition hover:bg-[#F7F9F8]"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"></path>
                            <circle cx="12" cy="12" r="2.5"></circle>
                        </svg>
                        Detail
                    </button>

                    <button
                        type="button"
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
                        data-alumni-lkd="{{ $pac->alumni_lkd }}"
                        data-deskripsi="{{ $pac->deskripsi }}"
                        onclick="openEditPACModal(this)"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#176B43] text-sm font-medium text-white transition hover:bg-[#0F5534]"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                        </svg>
                        Edit
                    </button>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-[18px] border border-[#E2E6E3] bg-white py-16 text-center text-sm text-[#747887]">
                Data PAC belum tersedia
            </div>
        @endforelse
    </div>

    @if($pacs->hasPages())
        <div class="pt-1">
            {{ $pacs->links() }}
        </div>
    @endif
</div>

<div
    id="pacPageState"
    data-open-create-modal="{{ $errors->any() ? 'true' : 'false' }}"
    hidden
></div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const chartCanvas = document.getElementById('statusPacChart');
    const pageState = document.getElementById('pacPageState');

    if (chartCanvas) {
        new Chart(chartCanvas, {
            type: 'bar',
            data: {
                labels: JSON.parse(chartCanvas.dataset.labels || '[]'),
                datasets: [{
                    data: JSON.parse(chartCanvas.dataset.values || '[]'),
                    backgroundColor: '#176B43',
                    borderRadius: 8,
                    borderSkipped: false,
                    maxBarThickness: 100,
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
                        ticks: {
                            color: '#8A8F9D',
                            font: { size: 11 },
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#E9EEEB',
                            borderDash: [4, 4],
                        },
                        ticks: {
                            color: '#8A8F9D',
                            precision: 0,
                            font: { size: 11 },
                        },
                    },
                },
            },
        });
    }

    if (pageState?.dataset.openCreateModal === 'true') {
        openTambahPACModal();
    }
});

function openTambahPACModal() {
    const modal = document.getElementById('modalTambahPAC');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeTambahPACModal() {
    const modal = document.getElementById('modalTambahPAC');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

function openDetailPACModal(button) {
    const modal = document.getElementById('modalDetailPAC');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('detailNamaPAC').innerText = button.dataset.nama;
    document.getElementById('detailKecamatan').innerText = button.dataset.kecamatan;
    document.getElementById('detailKetua').innerText = button.dataset.ketua || '-';
    document.getElementById('detailKontak').innerText = button.dataset.telepon || '-';
    document.getElementById('detailNomorSK').innerText = button.dataset.nomorSk || '-';
    document.getElementById('detailJumlahAnggota').innerText = button.dataset.jumlahAnggota || '0';
    document.getElementById('detailPertumbuhan').innerText = button.dataset.pertumbuhan || '0%';
    document.getElementById('detailAlumniLKD').innerText = button.dataset.alumniLkd || '0';
}

function closeDetailPACModal() {
    const modal = document.getElementById('modalDetailPAC');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

function openEditPACModal(button) {
    const modal = document.getElementById('modalEditPAC');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('editNamaPAC').value = button.dataset.nama || '';
    document.getElementById('editKecamatan').value = button.dataset.kecamatan || '';
    document.getElementById('editStatus').value = button.dataset.status || 'aktif';
    document.getElementById('editTanggalBerdiri').value = button.dataset.tanggalBerdiri || '';
    document.getElementById('editAlamat').value = button.dataset.alamat || '';
    document.getElementById('editDesa').value = button.dataset.desa || '';
    document.getElementById('editKodePos').value = button.dataset.kodePos || '';
    document.getElementById('editKetua').value = button.dataset.ketua || '';
    document.getElementById('editTelepon').value = button.dataset.telepon || '';
    document.getElementById('editEmail').value = button.dataset.email || '';
    document.getElementById('editNomorSK').value = button.dataset.nomorSk || '';
    document.getElementById('editJumlahAnggota').value = button.dataset.jumlahAnggota || 0;
    document.getElementById('editAlumniLKD').value = button.dataset.alumniLkd || 0;
    document.getElementById('editDeskripsi').value = button.dataset.deskripsi || '';
    document.getElementById('formEditPAC').action = `/data-pac/update/${button.dataset.id}`;
}

function closeEditPACModal() {
    const modal = document.getElementById('modalEditPAC');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

</script>

@include('partials.modalTambahPAC')
@include('partials.modalDetailPAC')
@include('partials.modalEditPAC')

@endsection
