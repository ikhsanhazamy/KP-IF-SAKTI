@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-[1600px] space-y-7">
    @if(session('success'))
        <div class="rounded-2xl bg-green-50 px-5 py-4 text-sm font-medium text-green-700 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-green-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-2xl bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-semibold">Terjadi kesalahan:</p>
            <ul class="mt-2 list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-[30px] font-bold tracking-[-0.03em] text-[#202321] sm:text-[34px]">
                Persetujuan Pengajuan PAC
            </h1>
            <p class="mt-2 text-[15px] text-[#747887] sm:text-base">
                Verifikasi dan kelola pengajuan pembentukan PAC baru yang diajukan oleh masyarakat
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a
                href="/pengajuan-data-pac"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex h-12 items-center justify-center gap-2 rounded-2xl border border-[#DFE4E1] bg-white px-5 text-sm font-semibold text-[#262926] transition hover:bg-[#F7F9F8]"
            >
                <svg class="h-4 w-4 text-[#176B43]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
                Lihat Form Publik
            </a>
            <a
                href="/data-pac"
                class="inline-flex h-12 items-center justify-center gap-2 rounded-2xl bg-[#176B43] px-6 text-sm font-semibold text-white transition hover:bg-[#0F5534]"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 21h16M6 21V7a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v14M17 10h2a1 1 0 0 1 1 1v10"></path>
                </svg>
                Daftar Data PAC
            </a>
        </div>
    </div>

    {{-- STATISTIC SUMMARY CARDS --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-[18px] border border-[#E2E6E3] bg-white px-6 py-5">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-[#747887]">Menunggu Persetujuan</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </span>
            </div>
            <h2 class="mt-2 text-[32px] font-bold tracking-[-0.03em] text-amber-600">
                {{ number_format($countPending) }}
            </h2>
            <p class="mt-1 text-xs text-[#8A8F9D]">Memerlukan tindakan admin</p>
        </div>

        <div class="rounded-[18px] border border-[#E2E6E3] bg-white px-6 py-5">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-[#747887]">Telah Disetujui / Aktif</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </span>
            </div>
            <h2 class="mt-2 text-[32px] font-bold tracking-[-0.03em] text-[#176B43]">
                {{ number_format($countAktif) }}
            </h2>
            <p class="mt-1 text-xs text-[#8A8F9D]">PAC berstatus resmi aktif</p>
        </div>

        <div class="rounded-[18px] border border-[#E2E6E3] bg-white px-6 py-5">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-[#747887]">Pengajuan Ditolak</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-red-50 text-red-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </span>
            </div>
            <h2 class="mt-2 text-[32px] font-bold tracking-[-0.03em] text-[#D92D4B]">
                {{ number_format($countDitolak) }}
            </h2>
            <p class="mt-1 text-xs text-[#8A8F9D]">Belum memenuhi syarat</p>
        </div>

        <div class="rounded-[18px] border border-[#E2E6E3] bg-white px-6 py-5">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-[#747887]">Total Arsip Pengajuan</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-gray-100 text-gray-700">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </span>
            </div>
            <h2 class="mt-2 text-[32px] font-bold tracking-[-0.03em] text-[#202321]">
                {{ number_format($countTotal) }}
            </h2>
            <p class="mt-1 text-xs text-[#8A8F9D]">Seluruh data di database</p>
        </div>
    </div>

    {{-- FILTER TABS & SEARCH BAR --}}
    <div class="rounded-[18px] border border-[#E2E6E3] bg-white p-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            {{-- STATUS TABS --}}
            <div class="flex flex-wrap items-center gap-2">
                @php
                    $tabs = [
                        ['id' => 'pending', 'label' => 'Menunggu Persetujuan', 'count' => $countPending, 'highlight' => true],
                        ['id' => 'all', 'label' => 'Semua Pengajuan', 'count' => $countTotal, 'highlight' => false],
                        ['id' => 'aktif', 'label' => 'Disetujui', 'count' => $countAktif, 'highlight' => false],
                        ['id' => 'ditolak', 'label' => 'Ditolak', 'count' => $countDitolak, 'highlight' => false],
                    ];
                @endphp

                @foreach($tabs as $tab)
                    @php
                        $isActive = $status === $tab['id'];
                    @endphp
                    <a
                        href="{{ route('pengajuan-pac.index', ['status' => $tab['id'], 'search' => $search]) }}"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold transition {{ $isActive ? 'bg-[#176B43] text-white shadow-sm' : 'bg-[#F2F7F4] text-[#747887] hover:bg-[#E7EFEA] hover:text-[#176B43]' }}"
                    >
                        <span>{{ $tab['label'] }}</span>
                        <span class="rounded-full px-2 py-0.5 text-xs {{ $isActive ? 'bg-white/20 text-white' : ($tab['id'] === 'pending' && $tab['count'] > 0 ? 'bg-amber-100 text-amber-800' : 'bg-white text-gray-600') }}">
                            {{ $tab['count'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            {{-- SEARCH FORM --}}
            <form action="{{ route('pengajuan-pac.index') }}" method="GET" class="flex items-center gap-2">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari pengajuan PAC / ketua..."
                        class="h-10 w-64 sm:w-80 rounded-xl border border-[#DFE4E1] bg-white pl-9 pr-4 text-sm text-[#262926] outline-none transition placeholder:text-[#A0A4AF] focus:border-[#176B43] focus:ring-2 focus:ring-[#176B43]/10"
                    >
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <button
                    type="submit"
                    class="h-10 rounded-xl bg-[#176B43] px-4 text-sm font-semibold text-white transition hover:bg-[#0F5534]"
                >
                    Cari
                </button>
                @if($search !== '')
                    <a
                        href="{{ route('pengajuan-pac.index', ['status' => $status]) }}"
                        class="h-10 inline-flex items-center rounded-xl border border-[#DFE4E1] px-3 text-sm font-medium text-gray-600 hover:bg-gray-50"
                    >
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- LIST / TABLE PENGAJUAN --}}
    <div class="overflow-hidden rounded-[18px] border border-[#E2E6E3] bg-white shadow-sm">
        <div class="border-b border-[#EDF0EE] px-6 py-4 flex items-center justify-between">
            <h2 class="text-base font-bold text-[#202321]">
                Daftar Pengajuan PAC
                <span class="text-xs font-normal text-gray-400 ml-2">
                    ({{ $pengajuans->total() }} data ditemukan)
                </span>
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-[#EDF0EE] bg-[#F9FBFA] text-xs font-semibold uppercase text-[#747887]">
                    <tr>
                        <th class="px-6 py-4">Nama PAC & Wilayah</th>
                        <th class="px-6 py-4">Ketua & Kontak</th>
                        <th class="px-6 py-4">Tgl Pengajuan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi Persetujuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EDF0EE] text-[#262926]">
                    @forelse($pengajuans as $pengajuan)
                        @php
                            $statusBadge = match($pengajuan->status) {
                                'pending' => ['label' => 'Menunggu Persetujuan', 'class' => 'bg-amber-50 text-amber-700 border-amber-200'],
                                'aktif' => ['label' => 'Disetujui (Aktif)', 'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                                'ditolak' => ['label' => 'Ditolak', 'class' => 'bg-red-50 text-red-700 border-red-200'],
                                default => ['label' => ucfirst($pengajuan->status), 'class' => 'bg-gray-50 text-gray-700 border-gray-200'],
                            };
                        @endphp
                        <tr class="transition hover:bg-[#F8FAF9]">
                            <td class="px-6 py-4">
                                <div class="font-bold text-[#202321] text-base">
                                    {{ $pengajuan->nama_pac }}
                                </div>
                                <div class="mt-1 flex items-center gap-1.5 text-xs text-[#747887]">
                                    <svg class="h-3.5 w-3.5 text-gray-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                        <circle cx="12" cy="10" r="2.5"></circle>
                                    </svg>
                                    <span>Kecamatan {{ $pengajuan->kecamatan }}{{ $pengajuan->desa ? ', Desa ' . $pengajuan->desa : '' }}</span>
                                </div>
                                @if($pengajuan->nomor_sk)
                                    <div class="mt-1 text-[11px] font-medium text-emerald-700">
                                        SK: {{ $pengajuan->nomor_sk }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">
                                    {{ $pengajuan->ketua_pac }}
                                </div>
                                <div class="mt-1 flex items-center gap-1 text-xs text-gray-500">
                                    <svg class="h-3.5 w-3.5 text-gray-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                    <span>{{ $pengajuan->telepon }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-700">
                                    {{ $pengajuan->created_at ? $pengajuan->created_at->locale('id')->translatedFormat('d M Y') : '-' }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $pengajuan->created_at ? $pengajuan->created_at->diffForHumans() : '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-semibold {{ $statusBadge['class'] }}">
                                    @if($pengajuan->status === 'pending')
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    @elseif($pengajuan->status === 'aktif')
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    @endif
                                    {{ $statusBadge['label'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-2">
                                    {{-- DETAIL BUTTON --}}
                                    <button
                                        type="button"
                                        onclick="showPengajuanDetail({{ $pengajuan->id }})"
                                        class="rounded-xl border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:bg-gray-50 cursor-pointer"
                                    >
                                        Detail
                                    </button>

                                    @if($pengajuan->status === 'pending')
                                        {{-- APPROVE BUTTON --}}
                                        <button
                                            type="button"
                                            onclick="openApproveModal({{ $pengajuan->id }}, '{{ addslashes($pengajuan->nama_pac) }}', '{{ addslashes($pengajuan->kecamatan) }}')"
                                            class="rounded-xl bg-[#176B43] px-3.5 py-1.5 text-xs font-semibold text-white transition hover:bg-[#0F5534] shadow-xs cursor-pointer flex items-center gap-1"
                                        >
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <path d="M20 6L9 17l-5-5"/>
                                            </svg>
                                            Setujui
                                        </button>

                                        {{-- REJECT BUTTON --}}
                                        <button
                                            type="button"
                                            onclick="openRejectModal({{ $pengajuan->id }}, '{{ addslashes($pengajuan->nama_pac) }}')"
                                            class="rounded-xl border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50 cursor-pointer"
                                        >
                                            Tolak
                                        </button>
                                    @elseif($pengajuan->status === 'aktif')
                                        <a
                                            href="/data-pac#pac-{{ $pengajuan->id }}"
                                            class="rounded-xl border border-emerald-200 bg-emerald-50/50 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-100/60 transition"
                                        >
                                            Buka di Data PAC &rarr;
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="h-10 w-10 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="9" y1="15" x2="15" y2="15"></line>
                                    </svg>
                                    <p class="text-base font-semibold text-gray-600">Tidak ada data pengajuan PAC</p>
                                    <p class="text-xs text-gray-400">
                                        @if($status === 'pending')
                                            Semua pengajuan yang masuk telah selesai ditinjau.
                                        @else
                                            Belum ada riwayat pengajuan dengan filter ini.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($pengajuans->hasPages())
            <div class="border-t border-[#EDF0EE] px-6 py-4">
                {{ $pengajuans->links() }}
            </div>
        @endif
    </div>
</div>

{{-- MODAL DETAIL PENGAJUAN --}}
<div
    id="modalDetailPengajuan"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-xs transition-opacity"
>
    <div class="relative w-full max-w-2xl rounded-3xl bg-white p-6 sm:p-8 shadow-2xl animate-in zoom-in-95 duration-150">
        <button
            type="button"
            onclick="closeDetailModal()"
            class="absolute right-5 top-5 rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700"
            aria-label="Tutup"
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <div class="flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#EAF3EE] text-[#176B43]">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
            </div>
            <div>
                <h3 id="modalDetailTitle" class="text-xl font-bold text-[#202321]">Detail Pengajuan PAC</h3>
                <p id="modalDetailSubtitle" class="text-xs text-gray-500">Informasi pengajuan data baru</p>
            </div>
        </div>

        <div class="mt-6 space-y-4 border-t border-gray-100 pt-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-2xl bg-[#F8FAF9] p-3.5">
                    <span class="text-xs text-gray-400 block">Kecamatan</span>
                    <span id="detailKecamatan" class="font-bold text-gray-800 text-sm"></span>
                </div>
                <div class="rounded-2xl bg-[#F8FAF9] p-3.5">
                    <span class="text-xs text-gray-400 block">Desa / Kelurahan</span>
                    <span id="detailDesa" class="font-bold text-gray-800 text-sm"></span>
                </div>
                <div class="rounded-2xl bg-[#F8FAF9] p-3.5">
                    <span class="text-xs text-gray-400 block">Ketua PAC Terpilih</span>
                    <span id="detailKetua" class="font-bold text-gray-800 text-sm"></span>
                </div>
                <div class="rounded-2xl bg-[#F8FAF9] p-3.5">
                    <span class="text-xs text-gray-400 block">Nomor Telepon / WhatsApp</span>
                    <span id="detailTelepon" class="font-bold text-gray-800 text-sm"></span>
                </div>
                <div class="rounded-2xl bg-[#F8FAF9] p-3.5">
                    <span class="text-xs text-gray-400 block">Email Kontak</span>
                    <span id="detailEmail" class="font-bold text-gray-800 text-sm"></span>
                </div>
                <div class="rounded-2xl bg-[#F8FAF9] p-3.5">
                    <span class="text-xs text-gray-400 block">Tanggal Penetapan SK / Berdiri</span>
                    <span id="detailTanggalBerdiri" class="font-bold text-gray-800 text-sm"></span>
                </div>
            </div>

            <div class="rounded-2xl bg-[#F8FAF9] p-4">
                <span class="text-xs text-gray-400 block">Alamat Sekretariat / Domisili</span>
                <p id="detailAlamat" class="font-medium text-gray-800 text-sm mt-1 leading-relaxed"></p>
            </div>

            <div class="rounded-2xl bg-[#F8FAF9] p-4">
                <span class="text-xs text-gray-400 block">Keterangan / Latar Belakang Pengajuan</span>
                <p id="detailDeskripsi" class="font-normal text-gray-700 text-sm mt-1 whitespace-pre-line leading-relaxed"></p>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
            <button
                type="button"
                onclick="closeDetailModal()"
                class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50"
            >
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- MODAL APPROVE PENGAJUAN --}}
<div
    id="modalApprovePengajuan"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-xs transition-opacity"
>
    <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 sm:p-8 shadow-2xl animate-in zoom-in-95 duration-150">
        <form id="approveForm" method="POST" action="">
            @csrf
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#202321]">Setujui Pengajuan PAC</h3>
                    <p class="text-xs text-gray-500">Konfirmasi persetujuan status PAC menjadi Aktif</p>
                </div>
            </div>

            <div class="mt-5 space-y-4">
                <p class="text-sm text-gray-600 leading-relaxed">
                    Anda akan menyetujui pembentukan <span id="approvePacName" class="font-bold text-gray-900"></span> di <span id="approveKecamatan" class="font-bold text-gray-900"></span>. Data ini akan langsung tercatat sebagai PAC aktif di sistem Fatayat NU Sukabumi.
                </p>

                <div>
                    <label for="approveNomorSk" class="block text-xs font-semibold text-gray-700 mb-1">
                        Nomor Surat Keputusan (SK) Resmi (Opsional)
                    </label>
                    <input
                        type="text"
                        name="nomor_sk"
                        id="approveNomorSk"
                        placeholder="Contoh: 042/SK/PC-FN/VII/2026"
                        class="w-full h-11 rounded-xl border border-[#DFE4E1] bg-white px-4 text-sm text-[#262926] outline-none focus:border-[#176B43] focus:ring-2 focus:ring-[#176B43]/10"
                    >
                    <p class="mt-1 text-[11px] text-gray-400">Nomor SK dapat dilengkapi atau diubah nanti melalui menu Data PAC.</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                <button
                    type="button"
                    onclick="closeApproveModal()"
                    class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 cursor-pointer"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="rounded-xl bg-[#176B43] px-6 py-2.5 text-sm font-semibold text-white hover:bg-[#0F5534] transition shadow-md cursor-pointer"
                >
                    Ya, Setujui Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL REJECT PENGAJUAN --}}
<div
    id="modalRejectPengajuan"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-xs transition-opacity"
>
    <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 sm:p-8 shadow-2xl animate-in zoom-in-95 duration-150">
        <form id="rejectForm" method="POST" action="">
            @csrf
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#202321]">Tolak Pengajuan PAC</h3>
                    <p class="text-xs text-gray-500">Tolak berkas pengajuan pembentukan PAC</p>
                </div>
            </div>

            <div class="mt-5 space-y-4">
                <p class="text-sm text-gray-600 leading-relaxed">
                    Pengajuan untuk <span id="rejectPacName" class="font-bold text-gray-900"></span> akan ditandai berstatus <strong class="text-red-600">Ditolak</strong>.
                </p>

                <div>
                    <label for="rejectAlasan" class="block text-xs font-semibold text-gray-700 mb-1">
                        Alasan Penolakan / Catatan Admin
                    </label>
                    <textarea
                        name="alasan_penolakan"
                        id="rejectAlasan"
                        rows="3"
                        placeholder="Contoh: Berkas persyaratan belum lengkap atau wilayah kecamatan sudah memiliki kepengurusan aktif."
                        class="w-full rounded-xl border border-[#DFE4E1] bg-white p-3 text-sm text-[#262926] outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/10"
                    ></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                <button
                    type="button"
                    onclick="closeRejectModal()"
                    class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 cursor-pointer"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="rounded-xl bg-[#D92D4B] px-6 py-2.5 text-sm font-semibold text-white hover:bg-red-700 transition shadow-md cursor-pointer"
                >
                    Tolak Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showPengajuanDetail(id) {
        fetch(`/pengajuan-pac/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('modalDetailTitle').textContent = data.nama_pac;
                document.getElementById('modalDetailSubtitle').textContent = `Diajukan pada ${data.created_at} (${data.created_at_relative})`;
                document.getElementById('detailKecamatan').textContent = data.kecamatan;
                document.getElementById('detailDesa').textContent = data.desa;
                document.getElementById('detailKetua').textContent = data.ketua_pac;
                document.getElementById('detailTelepon').textContent = data.telepon;
                document.getElementById('detailEmail').textContent = data.email;
                document.getElementById('detailTanggalBerdiri').textContent = data.tanggal_berdiri;
                document.getElementById('detailAlamat').textContent = data.alamat;
                document.getElementById('detailDeskripsi').textContent = data.deskripsi;

                const modal = document.getElementById('modalDetailPengajuan');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            })
            .catch(err => {
                alert('Gagal mengambil data detail pengajuan.');
            });
    }

    function closeDetailModal() {
        const modal = document.getElementById('modalDetailPengajuan');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openApproveModal(id, name, kec) {
        document.getElementById('approvePacName').textContent = name;
        document.getElementById('approveKecamatan').textContent = kec;
        document.getElementById('approveNomorSk').value = '';
        document.getElementById('approveForm').action = `/pengajuan-pac/${id}/approve`;

        const modal = document.getElementById('modalApprovePengajuan');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeApproveModal() {
        const modal = document.getElementById('modalApprovePengajuan');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openRejectModal(id, name) {
        document.getElementById('rejectPacName').textContent = name;
        document.getElementById('rejectAlasan').value = '';
        document.getElementById('rejectForm').action = `/pengajuan-pac/${id}/reject`;

        const modal = document.getElementById('modalRejectPengajuan');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeRejectModal() {
        const modal = document.getElementById('modalRejectPengajuan');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Escape key to close any open modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeDetailModal();
            closeApproveModal();
            closeRejectModal();
        }
    });
</script>

@endsection
