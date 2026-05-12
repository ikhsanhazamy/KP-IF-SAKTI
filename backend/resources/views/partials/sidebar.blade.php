<aside class="w-[260px] bg-white border-r min-h-screen flex flex-col">

    <!-- LOGO -->
    <div class="p-8 flex items-center gap-4">

        <div class="w-12 h-12 rounded-full bg-[#15633D] text-white flex items-center justify-center font-bold">
            FN
        </div>

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
    <nav class="px-4 flex-1">

        <a href="#"
           class="flex items-center gap-4 bg-[#15633D] text-white px-5 py-4 rounded-2xl mb-3">

            <img
            src="{{ asset('backend/icons/overview.svg') }}"
            class="w-6 h-6"
            alt="Overview"
            >
            <span>Overview</span>

        </a>

       <a href="/anggota"
        class="flex items-center gap-4 bg-[#15633D] text-white px-5 py-4 rounded-2xl mb-2">

             <img
            src="{{ asset('backend/icons/data anggota.svg') }}"
            class="w-6 h-6"
            alt="Data Anggota"
            >
             <span>Data Anggota</span>

        </a>

        <a href="#"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl mb-2">

                <img
                src="{{ asset('backend/icons/data PAC.svg') }}"
                class="w-6 h-6"
                alt="Data PAC"
                >
            <span>Data PAC</span>

        </a>

        <a href="#"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl mb-2">

                <img
                src="{{ asset('backend/icons/kegiatan.svg') }}"
                class="w-6 h-6"
                alt="Kegiatan"
                >
            <span>Kegiatan</span>

        </a>

        <a href="#"
           class="flex items-center gap-4 text-gray-600 hover:bg-gray-100 px-5 py-4 rounded-2xl mb-2">

            <img
            src="{{ asset('backend/icons/laporan.svg') }}"
            class="w-6 h-6"
            alt="Laporan"
            >
            <span>Laporan</span>

        </a>

        <a href="#"
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
    <div class="p-6">

        <button class="text-red-500 font-medium">
            Logout
        </button>

    </div>

</aside>