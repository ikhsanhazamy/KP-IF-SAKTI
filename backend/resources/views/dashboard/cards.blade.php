<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-2xl border p-6">

        <div class="flex justify-between mb-5">

            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center">
                <i class="ri-group-line text-xl text-[#15633D]"></i>
            </div>

        </div>

        <h2 class="text-4xl font-bold">
            {{ number_format($totalAnggota) }}
        </h2>

        <p class="text-gray-500 mt-2">
            Total Anggota
        </p>

    </div>

    <div class="bg-white rounded-2xl border p-6">

        <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center">
            <i class="ri-building-line text-xl text-[#15633D]"></i>
        </div>

        <h2 class="text-4xl font-bold mt-5">
            {{ $totalPAC }}
        </h2>

        <p class="text-gray-500 mt-2">
            Total PAC
        </p>

    </div>

    <div class="bg-white rounded-2xl border p-6">

        <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center">
            <i class="ri-calendar-event-line text-xl text-[#15633D]"></i>
        </div>

        <h2 class="text-4xl font-bold mt-5">
            {{ $kegiatanBulanIni }}
        </h2>

        <p class="text-gray-500 mt-2">
            Kegiatan Bulan Ini
        </p>

    </div>

    <div class="bg-white rounded-2xl border p-6">

        <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center">
            <i class="ri-user-star-line text-xl text-[#15633D]"></i>
        </div>

        <h2 class="text-4xl font-bold mt-5">
            {{ $anggotaAktif }}
        </h2>

        <p class="text-gray-500 mt-2">
            SK Aktif
        </p>

    </div>

</div>