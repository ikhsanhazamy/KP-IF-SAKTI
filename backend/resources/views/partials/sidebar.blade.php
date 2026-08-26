<aside class="hidden h-screen w-[276px] shrink-0 flex-col border-r border-[#E5E9E6] bg-white lg:flex">
    <div class="flex items-center gap-3 px-6 pb-7 pt-6">
        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#237A4B] text-sm font-bold text-white">
            FN
        </div>
        <div>
            <h1 class="text-base font-bold tracking-[-0.02em] text-[#202321]">Fatayat NU</h1>
            <p class="mt-0.5 text-xs text-[#8A8F9D]">Super Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-5">
        @php
            $overviewActive = request()->is('dashboard');
            $anggotaActive = request()->is('anggota*');
            $pacActive = request()->is('data-pac*');
            $kegiatanActive = request()->is('kegiatan*');
            $laporanActive = request()->is('laporan*');
            $pengaturanActive = request()->is('pengaturan*');
            $baseClass = 'flex items-center gap-4 rounded-2xl px-4 py-3.5 text-[15px] font-medium transition';
            $activeClass = 'bg-[#176B43] text-white shadow-[0_6px_16px_rgba(23,107,67,0.16)]';
            $inactiveClass = 'text-[#747887] hover:bg-[#F2F7F4] hover:text-[#176B43]';
        @endphp

        <a href="/dashboard" class="{{ $baseClass }} {{ $overviewActive ? $activeClass : $inactiveClass }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
                <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
            </svg>
            <span>Overview</span>
        </a>

        <a href="/anggota" class="{{ $baseClass }} {{ $anggotaActive ? $activeClass : $inactiveClass }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="8.5" cy="7.5" r="3"></circle>
                <path d="M3.5 20v-1.5A4.5 4.5 0 0 1 8 14h1a4.5 4.5 0 0 1 4.5 4.5V20"></path>
                <path d="M15 5a3 3 0 0 1 0 5.5M17 14a4.5 4.5 0 0 1 3.5 4.4V20"></path>
            </svg>
            <span>Data Anggota</span>
        </a>

        <a href="/data-pac" class="{{ $baseClass }} {{ $pacActive ? $activeClass : $inactiveClass }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 21h16M6 21V7a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v14M17 10h2a1 1 0 0 1 1 1v10"></path>
                <path d="M9 9h5M9 13h5M9 17h2"></path>
            </svg>
            <span>Data PAC</span>
        </a>

        <a href="/kegiatan" class="{{ $baseClass }} {{ $kegiatanActive ? $activeClass : $inactiveClass }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                <path d="M16 3v4M8 3v4M3 10h18"></path>
            </svg>
            <span>Kegiatan</span>
        </a>

        <a href="/laporan" class="{{ $baseClass }} {{ $laporanActive ? $activeClass : $inactiveClass }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M6 3h8l4 4v14H6z"></path>
                <path d="M14 3v4h4M9 12h6M9 16h6M9 8h2"></path>
            </svg>
            <span>Laporan</span>
        </a>

        <a href="/pengaturan" class="{{ $baseClass }} {{ $pengaturanActive ? $activeClass : $inactiveClass }}">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1Z"></path>
            </svg>
            <span>Pengaturan</span>
        </a>
    </nav>

    <div class="px-5 pb-7 pt-5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex w-full items-center gap-4 rounded-2xl px-4 py-3.5 text-[15px] font-medium text-[#D92D4B] transition hover:bg-[#FDECEF]">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M10 17l5-5-5-5M15 12H3M13 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
