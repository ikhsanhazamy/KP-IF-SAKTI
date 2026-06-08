<div class="bg-white rounded-2xl border p-6">

    <h2 class="font-bold text-xl mb-6">
        Top 5 PAC
    </h2>

    <div class="space-y-4">

        @foreach($topPAC as $index => $pac)

            <div class="flex justify-between items-center">

                <div class="flex gap-3">

                    <div class="w-8 h-8 rounded-xl bg-green-50 flex items-center justify-center">

                        <span class="font-bold text-[#15633D]">
                            {{ $index + 1 }}
                        </span>

                    </div>

                    <div>

                        <h3 class="font-medium">
                            {{ $pac->nama_pac }}
                        </h3>

                        <p class="text-xs text-gray-500">
                            {{ $pac->jumlah_anggota }} anggota
                        </p>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>