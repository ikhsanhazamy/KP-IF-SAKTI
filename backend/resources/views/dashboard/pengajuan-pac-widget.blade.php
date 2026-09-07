<section class="rounded-[20px] border border-[#E2E6E3] bg-white p-6 sm:p-7 shadow-sm">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between border-b border-[#EDF0EE] pb-5">
        <div class="flex items-center gap-3.5">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl {{ $pendingPacCount > 0 ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-lg font-bold text-[#202321]">Persetujuan Pengajuan PAC</h2>
                    @if($pendingPacCount > 0)
                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-bold text-amber-800">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                            {{ $pendingPacCount }} Perlu Tindakan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-800">
                            Semua Selesai
                        </span>
                    @endif
                </div>
                <p class="mt-0.5 text-xs text-[#747887]">
                    Pengajuan pembentukan Pimpinan Anak Cabang baru dari masyarakat
                </p>
            </div>
        </div>

        <a
            href="/pengajuan-pac"
            class="inline-flex items-center gap-1.5 rounded-xl border border-[#DFE4E1] bg-white px-4 py-2 text-xs font-semibold text-[#176B43] hover:bg-[#F2F7F4] transition"
        >
            <span>Buka Halaman Pengajuan PAC</span>
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if($pendingPacCount > 0 && isset($pengajuanPACPending) && $pengajuanPACPending->count() > 0)
        <div class="mt-5 overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-xs font-semibold text-[#8A8F9D] border-b border-[#EDF0EE]">
                        <th class="pb-3">Nama PAC</th>
                        <th class="pb-3">Kecamatan</th>
                        <th class="pb-3">Ketua & Kontak</th>
                        <th class="pb-3">Waktu Masuk</th>
                        <th class="pb-3 text-right">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EDF0EE]">
                    @foreach($pengajuanPACPending as $pengajuan)
                        <tr class="group hover:bg-[#F8FAF9]">
                            <td class="py-3.5 pr-4">
                                <div class="font-bold text-[#202321]">{{ $pengajuan->nama_pac }}</div>
                                <div class="text-xs text-gray-400">Desa {{ $pengajuan->desa ?? '-' }}</div>
                            </td>
                            <td class="py-3.5 pr-4 text-gray-700 font-medium">
                                {{ $pengajuan->kecamatan }}
                            </td>
                            <td class="py-3.5 pr-4">
                                <div class="font-medium text-gray-800">{{ $pengajuan->ketua_pac }}</div>
                                <div class="text-xs text-gray-500">{{ $pengajuan->telepon }}</div>
                            </td>
                            <td class="py-3.5 pr-4 text-xs text-gray-500 whitespace-nowrap">
                                {{ $pengajuan->created_at ? $pengajuan->created_at->diffForHumans() : '-' }}
                            </td>
                            <td class="py-3.5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <form action="{{ route('pengajuan-pac.approve', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Setujui pengajuan {{ addslashes($pengajuan->nama_pac) }}?')">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1 rounded-xl bg-[#176B43] px-3 py-1.5 text-xs font-semibold text-white hover:bg-[#0F5534] transition cursor-pointer shadow-2xs"
                                        >
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <path d="M20 6L9 17l-5-5"/>
                                            </svg>
                                            Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('pengajuan-pac.reject', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Tolak pengajuan {{ addslashes($pengajuan->nama_pac) }}?')">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="inline-flex items-center rounded-xl border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 transition cursor-pointer"
                                        >
                                            Tolak
                                        </button>
                                    </form>

                                    <a
                                        href="{{ route('pengajuan-pac.index', ['search' => $pengajuan->nama_pac]) }}"
                                        class="rounded-xl border border-gray-200 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 transition"
                                    >
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="mt-5 flex flex-col items-center justify-center py-6 text-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 mb-2">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h3 class="text-sm font-bold text-gray-800">Tidak ada pengajuan PAC yang menunggu persetujuan</h3>
            <p class="text-xs text-gray-400 mt-1 max-w-sm">
                Setiap pengajuan baru yang dikirimkan melalui website publik akan muncul di sini untuk ditinjau dan disetujui.
            </p>
        </div>
    @endif
</section>
