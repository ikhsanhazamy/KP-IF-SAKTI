<aside class="w-[260px] bg-white border-r h-screen flex flex-col shrink-0">

    <!-- LOGO -->
    <div class="p-8 flex items-center gap-4">

        <img
            src="{{ asset('backend/icons/logo.svg') }}"
            class="w-12 h-12"
            alt="Logo"
        >

        <div>
            <h1 class="font-bold text-lg">
                Fatayat NU
            </h1>

            <p class="text-sm text-gray-500">
                Super Admin
            </p>
        </div>

    </div>

    <!-- MENU -->
    <nav class="px-4 flex-1 overflow-y-auto">

        <!-- OVERVIEW -->
        @php
            $overviewActive = request()->is('dashboard');
        @endphp

        <a href="/dashboard"
           class="{{ $overviewActive ? 'bg-[#15633D] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-4 px-5 py-4 rounded-2xl mb-2 transition">

            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="3" width="7" height="7" rx="2" />
                <rect x="14" y="3" width="7" height="7" rx="2" />
                <rect x="3" y="14" width="7" height="7" rx="2" />
                <rect x="14" y="14" width="7" height="7" rx="2" />
            </svg>

            <span>Overview</span>

        </a>

        <!-- DATA ANGGOTA -->
        @php
            $anggotaActive = request()->is('anggota*');
        @endphp

        <a href="/anggota"
           class="{{ $anggotaActive ? 'bg-[#15633D] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-4 px-5 py-4 rounded-2xl mb-2 transition">

            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="8" cy="8" r="3" />
                <path d="M5 20c0-2.5 2-4.5 4.5-4.5S14 17.5 14 20" />
                <circle cx="17" cy="7" r="2.5" />
                <path d="M15 20c0-1.7 1.3-3 3-3s3 1.3 3 3" />
            </svg>

            <span>Data Anggota</span>

        </a>

        <!-- DATA PAC -->
        @php
            $pacActive = request()->is('data-pac*');
        @endphp

        <a href="/data-pac"
           class="{{ $pacActive ? 'bg-[#15633D] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-4 px-5 py-4 rounded-2xl mb-2 transition">

            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 22V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v15" />
                <path d="M9 22V12h6v10" />
                <path d="M8 6h8" />
                <path d="M7 10h2" />
                <path d="M15 10h2" />
            </svg>

            <span>Data PAC</span>

        </a>

        <!-- KEGIATAN -->
        @php
            $kegiatanActive = request()->is('kegiatan*');
        @endphp

        <a href="/kegiatan"
           class="{{ $kegiatanActive ? 'bg-[#15633D] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-4 px-5 py-4 rounded-2xl mb-2 transition">

            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4" />
                <path d="M8 2v4" />
                <path d="M3 10h18" />
                <path d="M8 14h2" />
                <path d="M14 14h2" />
                <path d="M8 18h2" />
                <path d="M14 18h2" />
            </svg>

            <span>Kegiatan</span>

        </a>

        <!-- LAPORAN -->
        @php
            $laporanActive = request()->is('laporan*');
        @endphp

        <a href="/laporan"
           class="{{ $laporanActive ? 'bg-[#15633D] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-4 px-5 py-4 rounded-2xl mb-2 transition">

            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M6 2h8l4 4v16H6V2z" />
                <path d="M14 2v4h4" />
                <path d="M9 13h6" />
                <path d="M9 17h6" />
                <path d="M9 9h2" />
            </svg>

            <span>Laporan</span>

        </a>

        <!-- PENGATURAN -->
        @php
            $pengaturanActive = request()->is('pengaturan*');
        @endphp

        <a href="/pengaturan"
           class="{{ $pengaturanActive ? 'bg-[#15633D] text-white' : 'text-gray-600 hover:bg-gray-100' }} flex items-center gap-4 px-5 py-4 rounded-2xl transition">

            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="3.5" />
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09c.7 0 1.34-.4 1.51-1a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09c0 .7.4 1.34 1 1.51a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.7 0 1.34.4 1.51 1H21a2 2 0 1 1 0 4h-.09c-.7 0-1.34.4-1.51 1Z" />
            </svg>

            <span>Pengaturan</span>

        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="p-6 border-t">

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button
                type="submit"
                class="text-red-500 font-medium hover:text-red-600 transition">

                Logout

            </button>

        </form>

    </div>

</aside>