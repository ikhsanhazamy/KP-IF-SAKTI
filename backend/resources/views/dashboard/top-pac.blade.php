<section class="rounded-[18px] border border-[#E2E6E3] bg-white p-6">
    <h2 class="mb-5 text-lg font-bold text-[#202321]">Top 5 PAC</h2>

    <div class="space-y-2">
        @forelse($topPAC as $index => $pac)
            @php
                $isPositive = $pac->growth > 0;
                $isNegative = $pac->growth < 0;
                $growthClass = $isPositive
                    ? 'bg-[#EEF7F1] text-[#4FA36C]'
                    : ($isNegative ? 'bg-[#FDECEF] text-[#D92D4B]' : 'bg-[#F2F4F3] text-[#7A807C]');
            @endphp

            <div class="flex items-center justify-between gap-3 rounded-xl py-2">
                <div class="flex min-w-0 items-center gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#EAF3EE] text-sm font-bold text-[#176B43]">
                        {{ $index + 1 }}
                    </div>

                    <div class="min-w-0">
                        <h3 class="truncate text-sm font-medium text-[#262926]">{{ $pac->nama_pac }}</h3>
                        <p class="mt-0.5 text-xs text-[#8A8F9D]">
                            {{ number_format($pac->jumlah_anggota) }} anggota
                        </p>
                    </div>
                </div>

                <span class="{{ $growthClass }} shrink-0 rounded-full px-2.5 py-1 text-[11px] font-semibold">
                    {{ $pac->growth > 0 ? '+' : '' }}{{ $pac->growth }}%
                </span>
            </div>
        @empty
            <p class="py-8 text-center text-sm text-[#8A8F9D]">Data PAC belum tersedia</p>
        @endforelse
    </div>
</section>
