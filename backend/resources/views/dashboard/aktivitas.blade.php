<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm w-full flex flex-col justify-between">

    <div>
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-bold text-gray-900 text-[16px]">
                Aktivitas Terbaru
            </h2>
            <a href="/kegiatan" class="text-xs font-bold text-[#0F5E3A] hover:underline flex items-center gap-1 transition">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="space-y-4">

            @forelse($aktivitasTerbaru as $item)

                <div class="flex items-start gap-3">

                    <div class="w-9 h-9 rounded-full bg-[#eef3f0] flex items-center justify-center text-[#0F5E3A] shrink-0 mt-0.5">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>

                    <div class="flex-1">

                        <h3 class="font-semibold text-gray-900 text-[13px] leading-snug">
                            {{ $item->judul }}
                        </h3>

                        <p class="text-[11px] text-[#717182] mt-0.5">
                            {{ $item->created_at->diffForHumans() }}
                        </p>

                    </div>

                </div>

            @empty

                <p class="text-xs text-gray-400 text-center py-6">
                    Belum ada aktivitas baru.
                </p>

            @endforelse

        </div>
    </div>

</div>