<div class="space-y-4">
    @if(session('success'))
        <div class="rounded-xl bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-gray-200 bg-white p-6">
        <h2 class="mb-6 text-[20px] font-bold text-[#1D1D1D]">
            Preferensi Notifikasi
        </h2>

        <form method="POST" action="{{ route('pengaturan.notifikasi.update') }}">
            @csrf

            <div class="space-y-5">
                @php
                    $notificationOptions = [
                        [
                            'name' => 'email_notification',
                            'title' => 'Notifikasi Email',
                            'description' => 'Terima informasi kegiatan dan laporan melalui email',
                        ],
                        [
                            'name' => 'kegiatan_notification',
                            'title' => 'Notifikasi Kegiatan',
                            'description' => 'Pemberitahuan kegiatan yang akan datang',
                        ],
                        [
                            'name' => 'anggota_notification',
                            'title' => 'Notifikasi Anggota Baru',
                            'description' => 'Dapatkan pemberitahuan saat ada anggota baru',
                        ],
                        [
                            'name' => 'pac_notification',
                            'title' => 'Notifikasi PAC',
                            'description' => 'Informasi perubahan data PAC',
                        ],
                    ];
                @endphp

                @foreach($notificationOptions as $option)
                    <div class="flex items-center justify-between gap-6 rounded-2xl border border-gray-200 p-5">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $option['title'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $option['description'] }}</p>
                        </div>

                        <label class="relative inline-flex shrink-0 cursor-pointer items-center">
                            <input type="hidden" name="{{ $option['name'] }}" value="0">
                            <input
                                type="checkbox"
                                name="{{ $option['name'] }}"
                                value="1"
                                class="peer sr-only"
                                @checked((bool) $pengaturan->{$option['name']})
                            >
                            <span class="h-6 w-11 rounded-full bg-gray-200 transition peer-checked:bg-[#15633D]"></span>
                            <span class="absolute left-[2px] top-[2px] h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-full"></span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-end">
                <button
                    type="submit"
                    class="rounded-xl bg-[#15633D] px-6 py-3 text-white hover:bg-[#0F5E3A]"
                >
                    Simpan Preferensi
                </button>
            </div>
        </form>
    </div>
</div>
