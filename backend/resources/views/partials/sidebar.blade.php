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
        <a href="#"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl mb-2">

            <img
                src="{{ asset('backend/icons/overview.svg') }}"
                class="w-6 h-6"
                alt="Overview"
            >

            <span>Overview</span>

        </a>

        <!-- DATA ANGGOTA -->
        <a href="/anggota"
           class="flex items-center gap-4 bg-[#15633D] text-white px-5 py-4 rounded-2xl mb-2">

            <img
                src="{{ asset('backend/icons/data-anggota.svg') }}"
                class="w-6 h-6"
                alt="Data Anggota"
            >

            <span>Data Anggota</span>

        </a>

        <!-- DATA PAC -->
        <a href="/data-pac"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl mb-2">

            <img
                src="{{ asset('backend/icons/data-pac.svg') }}"
                class="w-6 h-6"
                alt="Data PAC"
            >

            <span>Data PAC</span>

        </a>

        <!-- KEGIATAN -->
        <a href="/kegiatan"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl mb-2">

            <img
                src="{{ asset('backend/icons/kegiatan.svg') }}"
                class="w-6 h-6"
                alt="Kegiatan"
            >

            <span>Kegiatan</span>

        </a>

        <!-- LAPORAN -->
        <a href="/laporan"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl mb-2">

            <img
                src="{{ asset('backend/icons/laporan.svg') }}"
                class="w-6 h-6"
                alt="Laporan"
            >

            <span>Laporan</span>

        </a>

        <!-- PENGATURAN -->
        <a href="/pengaturan"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl">

            <img
                src="{{ asset('backend/icons/pengaturan.svg') }}"
                class="w-6 h-6"
                alt="Pengaturan"
            >

            <span>Pengaturan</span>

        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="p-6 border-t">

        <button class="text-red-500 font-medium">
            Log out
        </button>

    </div>

</aside>