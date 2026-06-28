<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">

    <h2 class="font-bold text-gray-900 text-[16px] mb-4">
        Status PAC
    </h2>

    <div class="h-[140px] relative flex items-center justify-center">

        <canvas id="pacChart" class="max-h-full"></canvas>

    </div>

    <div class="flex items-center justify-center gap-5 mt-4">

        <div class="flex items-center gap-1.5">

            <span class="w-2.5 h-2.5 rounded-full bg-[#0F5E3A]"></span>

            <span class="text-[11px] font-semibold text-gray-600">

                PAC Aktif: {{ $pacAktif }}

            </span>

        </div>

        <div class="flex items-center gap-1.5">

            <span class="w-2.5 h-2.5 rounded-full bg-[#DDE9E1]"></span>

            <span class="text-[11px] font-semibold text-gray-400">

                PAC Tidak Aktif: {{ $pacTidakAktif }}

            </span>

        </div>

    </div>

</div>