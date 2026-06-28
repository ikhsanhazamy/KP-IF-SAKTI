<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Card 1: Total Anggota -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between h-[156px] shadow-sm">
        <div class="flex justify-between items-center">
            <div class="w-10 h-10 rounded-full bg-[#eef3f0] flex items-center justify-center text-[#0F5E3A]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <span class="inline-flex items-center gap-0.5 bg-green-50 text-green-700 px-2 py-0.5 rounded-full text-[11px] font-semibold">
                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                +12%
            </span>
        </div>
        <div class="mt-auto">
            <h2 class="text-2xl font-bold text-gray-900 leading-none">
                {{ number_format($totalAnggota, 0, ',', '.') }}
            </h2>
            <p class="text-xs text-gray-400 mt-1.5 font-medium">
                Total Anggota
            </p>
        </div>
    </div>

    <!-- Card 2: PAC Aktif -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between h-[156px] shadow-sm">
        <div class="flex justify-between items-center">
            <div class="w-10 h-10 rounded-full bg-[#eef3f0] flex items-center justify-center text-[#0F5E3A]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <span class="inline-flex items-center gap-0.5 bg-green-50 text-green-700 px-2 py-0.5 rounded-full text-[11px] font-semibold">
                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                +3
            </span>
        </div>
        <div class="mt-auto">
            <h2 class="text-2xl font-bold text-gray-900 leading-none">
                {{ $pacAktif }}
            </h2>
            <p class="text-xs text-gray-400 mt-1.5 font-medium">
                PAC Aktif
            </p>
        </div>
    </div>

    <!-- Card 3: Kegiatan Bulan Ini -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between h-[156px] shadow-sm">
        <div class="flex justify-between items-center">
            <div class="w-10 h-10 rounded-full bg-[#eef3f0] flex items-center justify-center text-[#0F5E3A]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
            </div>
            <span class="inline-flex items-center gap-0.5 bg-green-50 text-green-700 px-2 py-0.5 rounded-full text-[11px] font-semibold">
                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                +8
            </span>
        </div>
        <div class="mt-auto">
            <h2 class="text-2xl font-bold text-gray-900 leading-none">
                {{ $kegiatanBulanIni }}
            </h2>
            <p class="text-xs text-gray-400 mt-1.5 font-medium">
                Kegiatan Bulan Ini
            </p>
        </div>
    </div>

    <!-- Card 4: SK Aktif -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between h-[156px] shadow-sm">
        <div class="flex justify-between items-center">
            <div class="w-10 h-10 rounded-full bg-[#eef3f0] flex items-center justify-center text-[#0F5E3A]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <span class="inline-flex items-center gap-0.5 bg-red-50 text-red-600 px-2 py-0.5 rounded-full text-[11px] font-semibold">
                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                -2
            </span>
        </div>
        <div class="mt-auto">
            <h2 class="text-2xl font-bold text-gray-900 leading-none">
                {{ $anggotaAktif }}
            </h2>
            <p class="text-xs text-gray-400 mt-1.5 font-medium">
                SK Aktif
            </p>
        </div>
    </div>

</div>