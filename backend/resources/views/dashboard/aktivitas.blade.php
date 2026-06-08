<div class="xl:col-span-2 bg-white rounded-2xl border p-6">

    <h2 class="font-bold text-xl mb-6">
        Aktivitas Terbaru
    </h2>

    <div class="space-y-4">

        @forelse($aktivitasTerbaru as $item)

            <div class="flex gap-4">

                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">

                    <i class="ri-pulse-line text-[#15633D]"></i>

                </div>

                <div>

                    <h3 class="font-medium">
                        {{ $item->judul }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        {{ $item->created_at->diffForHumans() }}
                    </p>

                </div>

            </div>

        @empty

            <p class="text-gray-500">
                Belum ada aktivitas
            </p>

        @endforelse

    </div>

</div>