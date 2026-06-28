<aside class="w-[260px] bg-white border-r border-gray-100 h-screen flex flex-col shrink-0">

    <!-- LOGO -->
    <div class="px-6 py-7 flex items-center gap-3 border-b border-gray-100">
        <div class="w-10 h-10 rounded-full bg-[#0F5E3A] flex items-center justify-center font-bold text-white text-sm tracking-wider">
            FN
        </div>
        <div>
            <h2 class="font-bold text-gray-900 text-[15px] leading-tight">
                Fatayat NU
            </h2>
            <p class="text-[11px] text-[#717182] font-medium mt-0.5">
                Super Admin
            </p>
        </div>
    </div>

    <!-- MENU -->
    <nav class="px-4 py-6 flex-1 flex flex-col gap-1 overflow-y-auto">

        <!-- OVERVIEW -->
        @php
            $overviewActive = request()->is('dashboard');
        @endphp
        <a href="/dashboard"
           class="flex items-center gap-3 px-5 py-3.5 rounded-xl text-[14px] transition duration-200 {{ $overviewActive ? 'bg-[#0F5E3A] text-white font-semibold shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1.5" />
                <rect x="14" y="3" width="7" height="7" rx="1.5" />
                <rect x="3" y="14" width="7" height="7" rx="1.5" />
                <rect x="14" y="14" width="7" height="7" rx="1.5" />
            </svg>
            <span>Overview</span>
        </a>

        <!-- DATA ANGGOTA -->
        @php
            $anggotaActive = request()->is('anggota*');
        @endphp
        <a href="/anggota"
           class="flex items-center gap-3 px-5 py-3.5 rounded-xl text-[14px] transition duration-200 {{ $anggotaActive ? 'bg-[#0F5E3A] text-white font-semibold shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            <span>Data Anggota</span>
        </a>

        <!-- DATA PAC -->
        @php
            $pacActive = request()->is('data-pac*');
        @endphp
        <a href="/data-pac"
           class="flex items-center gap-3 px-5 py-3.5 rounded-xl text-[14px] transition duration-200 {{ $pacActive ? 'bg-[#0F5E3A] text-white font-semibold shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21h18" />
                <path d="M9 21V9a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v12" />
                <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16" />
            </svg>
            <span>Data PAC</span>
        </a>

        <!-- KEGIATAN -->
        @php
            $kegiatanActive = request()->is('kegiatan*');
        @endphp
        <a href="/kegiatan"
           class="flex items-center gap-3 px-5 py-3.5 rounded-xl text-[14px] transition duration-200 {{ $kegiatanActive ? 'bg-[#0F5E3A] text-white font-semibold shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            <span>Kegiatan</span>
        </a>

        <!-- LAPORAN -->
        @php
            $laporanActive = request()->is('laporan*');
        @endphp
        <a href="/laporan"
           class="flex items-center gap-3 px-5 py-3.5 rounded-xl text-[14px] transition duration-200 {{ $laporanActive ? 'bg-[#0F5E3A] text-white font-semibold shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
                <line x1="16" y1="13" x2="8" y2="13" />
                <line x1="16" y1="17" x2="8" y2="17" />
                <polyline points="10 9 9 9 8 9" />
            </svg>
            <span>Laporan</span>
        </a>

        <!-- PENGATURAN -->
        @php
            $pengaturanActive = request()->is('pengaturan*');
        @endphp
        <a href="/pengaturan"
           class="flex items-center gap-3 px-5 py-3.5 rounded-xl text-[14px] transition duration-200 {{ $pengaturanActive ? 'bg-[#0F5E3A] text-white font-semibold shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09c.7 0 1.34-.4 1.51-1a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09c0 .7.4 1.34 1 1.51a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.7 0 1.34.4 1.51 1H21a2 2 0 1 1 0 4h-.09c-.7 0-1.34.4-1.51 1Z" />
            </svg>
            <span>Pengaturan</span>
        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="p-4 border-t border-gray-100">
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-5 py-3.5 rounded-xl text-red-500 hover:bg-red-50 hover:text-red-600 font-semibold text-[14px] transition duration-200 cursor-pointer">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>