<section class="min-h-[510px] rounded-[18px] border border-[#E2E6E3] bg-white p-6">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-lg font-bold text-[#202321]">Aktivitas Terbaru</h2>
        <a href="/kegiatan" class="text-sm font-semibold text-[#176B43] transition hover:text-[#0F5534]">
            Lihat Semua
            <span aria-hidden="true">&rarr;</span>
        </a>
    </div>

    <div class="space-y-1">
        @forelse($aktivitasTerbaru as $item)
            <div class="flex items-center gap-4 rounded-xl px-3 py-4 transition hover:bg-[#F8FAF8]">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#EDF7F1] text-[#4FA36C]">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        @if($item['jenis'] === 'anggota')
                            <circle cx="9" cy="8" r="3"></circle>
                            <path d="M4 20a5 5 0 0 1 10 0M16 11v6M13 14h6"></path>
                        @elseif($item['jenis'] === 'pac')
                            <path d="M4 21h16M6 21V5h9v16M15 10h3v11M9 9h3M9 13h3M9 17h3"></path>
                        @else
                            <path d="M3 12h4l2-6 4 12 2-6h6"></path>
                        @endif
                    </svg>
                </div>

                <div class="min-w-0">
                    <h3 class="truncate text-sm font-medium text-[#262926]">{{ $item['judul'] }}</h3>
                    <p class="mt-1 text-xs text-[#8A8F9D]">
                        {{ $item['waktu']->locale('id')->diffForHumans() }}
                    </p>
                </div>
            </div>
        @empty
            <div class="flex min-h-[360px] items-center justify-center text-sm text-[#8A8F9D]">
                Belum ada aktivitas terbaru
            </div>
        @endforelse
    </div>
</section>
