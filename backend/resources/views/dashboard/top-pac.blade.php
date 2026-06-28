<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

    <h2 class="font-bold text-gray-900 text-[16px] mb-5">
        Top 5 PAC
    </h2>

    <div class="space-y-3.5">

        @foreach($topPAC as $index => $pac)
            @php
                $growthPercentages = ['+12%', '+10%', '+8%', '+7%', '+16%'];
                $growth = $growthPercentages[$index] ?? '+5%';
            @endphp

            <div class="flex justify-between items-center">

                <div class="flex items-center gap-3">

                    <div class="w-8 h-8 rounded-lg bg-[#eef3f0] flex items-center justify-center shrink-0">

                        <span class="font-bold text-[#0F5E3A] text-sm">
                            {{ $index + 1 }}
                        </span>

                    </div>

                    <div>

                        <h3 class="font-semibold text-gray-900 text-[13px] leading-tight">
                            {{ $pac->nama_pac }}
                        </h3>

                        <p class="text-[11px] text-[#717182] mt-0.5">
                            {{ number_format($pac->jumlah_anggota, 0, ',', '.') }} anggota
                        </p>

                    </div>

                </div>

                <span class="inline-flex items-center bg-[#eef3f0] text-[#0F5E3A] px-2 py-0.5 rounded-full text-[10px] font-bold">
                    {{ $growth }}
                </span>

            </div>

        @endforeach

    </div>

</div>