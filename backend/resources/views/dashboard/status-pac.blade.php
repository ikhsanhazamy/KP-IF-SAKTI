<section class="rounded-[18px] border border-[#E2E6E3] bg-white p-6">
    <h2 class="text-lg font-bold text-[#202321]">Status PAC</h2>
    <div class="mx-auto mt-5 h-[170px] max-w-[220px]">
        <canvas id="pacChart"></canvas>
    </div>

    <div class="mt-3 flex flex-wrap items-center justify-center gap-x-5 gap-y-2 text-xs text-[#747887]">
        <span class="inline-flex items-center gap-2">
            <span class="h-2.5 w-2.5 rounded-full bg-[#4FA36C]"></span>
            PAC Aktif: {{ $pacAktif }}
        </span>
        <span class="inline-flex items-center gap-2">
            <span class="h-2.5 w-2.5 rounded-full bg-[#DCECE3]"></span>
            Tidak Aktif: {{ $pacTidakAktif }}
        </span>
    </div>
</section>
