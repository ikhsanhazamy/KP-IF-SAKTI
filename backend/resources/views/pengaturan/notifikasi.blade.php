<div class="bg-white rounded-2xl border border-gray-200 p-6">

    <h2 class="text-[20px] font-bold text-[#1D1D1D] mb-6">
        Preferensi Notifikasi
    </h2>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('pengaturan.notifikasi.update') }}"
    >
        @csrf

        <div class="space-y-5">

            <!-- Email -->
            <div class="border border-gray-200 rounded-2xl p-5 flex justify-between items-center">

                <div>
                    <h3 class="font-semibold text-lg">
                        Notifikasi Email
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Terima informasi kegiatan dan laporan melalui email
                    </p>
                </div>

                <input
                    type="checkbox"
                    name="email_notification"
                    value="1"
                    class="w-6 h-6 accent-green-700"
                    checked
                >
            </div>

            <!-- Kegiatan -->
            <div class="border border-gray-200 rounded-2xl p-5 flex justify-between items-center">

                <div>
                    <h3 class="font-semibold text-lg">
                        Notifikasi Kegiatan
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Pemberitahuan kegiatan yang akan datang
                    </p>
                </div>

                <input
                    type="checkbox"
                    name="kegiatan_notification"
                    value="1"
                    class="w-6 h-6 accent-green-700"
                    checked
                >
            </div>

            <!-- Anggota -->
            <div class="border border-gray-200 rounded-2xl p-5 flex justify-between items-center">

                <div>
                    <h3 class="font-semibold text-lg">
                        Notifikasi Anggota Baru
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Dapatkan pemberitahuan saat ada anggota baru
                    </p>
                </div>

                <input
                    type="checkbox"
                    name="anggota_notification"
                    value="1"
                    class="w-6 h-6 accent-green-700"
                    checked
                >
            </div>

            <!-- PAC -->
            <div class="border border-gray-200 rounded-2xl p-5 flex justify-between items-center">

                <div>
                    <h3 class="font-semibold text-lg">
                        Notifikasi PAC
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Informasi perubahan data PAC
                    </p>
                </div>

                <input
                    type="checkbox"
                    name="pac_notification"
                    value="1"
                    class="w-6 h-6 accent-green-700"
                >
            </div>

        </div>

        <div class="flex justify-end mt-8">

            <button
                type="submit"
                class="bg-[#15633D] text-white px-6 py-3 rounded-xl hover:bg-[#0f4d2f]"
            >
                Simpan Preferensi
            </button>

        </div>

    </form>

</div>