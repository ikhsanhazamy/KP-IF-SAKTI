@php
    $cards = [
        [
            'label' => 'Total Anggota',
            'value' => $totalAnggota,
            'growth' => $growth['anggota'],
            'icon' => 'anggota',
        ],
        [
            'label' => 'PAC Aktif',
            'value' => $pacAktif,
            'growth' => $growth['pac'],
            'icon' => 'pac',
        ],
        [
            'label' => 'Kegiatan Bulan Ini',
            'value' => $kegiatanBulanIni,
            'growth' => $growth['kegiatan'],
            'icon' => 'kegiatan',
        ],
        [
            'label' => 'SK Aktif',
            'value' => $skAktif,
            'growth' => $growth['sk'],
            'icon' => 'sk',
        ],
    ];
@endphp

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
    @foreach($cards as $card)
        @php
            $isPositive = $card['growth'] > 0;
            $isNegative = $card['growth'] < 0;
            $badgeClass = $isPositive
                ? 'bg-[#EEF7F1] text-[#4FA36C]'
                : ($isNegative ? 'bg-[#FDECEF] text-[#D92D4B]' : 'bg-[#F2F4F3] text-[#7A807C]');
        @endphp

        <article class="rounded-[18px] border border-[#E2E6E3] bg-white p-6 shadow-[0_1px_2px_rgba(16,24,20,0.02)]">
            <div class="flex items-center justify-between">
                <div class="flex h-[52px] w-[52px] items-center justify-center rounded-2xl bg-[#EAF3EE] text-[#176B43]">
                    @if($card['icon'] === 'anggota')
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="9" cy="7" r="3"></circle>
                            <path d="M3.5 20v-1.5A4.5 4.5 0 0 1 8 14h2a4.5 4.5 0 0 1 4.5 4.5V20"></path>
                            <path d="M16 4.5a3 3 0 0 1 0 5.8M17.5 14.2a4.5 4.5 0 0 1 3 4.3V20"></path>
                        </svg>
                    @elseif($card['icon'] === 'pac')
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="3" width="11" height="18" rx="1.5"></rect>
                            <path d="M8 7h5M8 10h5M8 13h5M8 17h2M16 9h3v12h-3"></path>
                        </svg>
                    @elseif($card['icon'] === 'kegiatan')
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                            <path d="M16 3v4M8 3v4M3 10h18"></path>
                        </svg>
                    @else
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M6 2.8h8l4 4V21H6z"></path>
                            <path d="M14 2.8v4h4M9 12h6M9 16h6M9 8h2"></path>
                        </svg>
                    @endif
                </div>

                <span class="{{ $badgeClass }} inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold">
                    <svg class="h-3.5 w-3.5 {{ $isNegative ? 'rotate-90' : '' }}" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        @if($card['growth'] === 0)
                            <path d="M3 8h10"></path>
                        @else
                            <path d="M4 12 12 4M6 4h6v6"></path>
                        @endif
                    </svg>
                    {{ $card['growth'] > 0 ? '+' : '' }}{{ $card['growth'] }}%
                </span>
            </div>

            <h2 class="mt-5 text-[34px] font-bold tracking-[-0.03em] text-[#202321]">
                {{ number_format($card['value']) }}
            </h2>
            <p class="mt-1 text-sm text-[#747887]">{{ $card['label'] }}</p>
        </article>
    @endforeach
</div>
