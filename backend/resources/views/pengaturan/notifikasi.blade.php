<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

    <h2 class="text-[16px] font-bold text-gray-900 mb-6 pb-2 border-b border-gray-50">
        Preferensi Notifikasi
    </h2>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-100 text-[#0F5E3A] px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('pengaturan.notifikasi.update') }}"
        class="m-0"
    >
        @csrf

        <div class="space-y-4">

            <!-- Email -->
            <div class="border border-gray-100 rounded-2xl p-4 flex justify-between items-center bg-gray-50/50">
                <div>
                    <h3 class="text-[13px] font-bold text-gray-800">
                        Notifikasi Email
                    </h3>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">
                        Terima informasi kegiatan dan laporan melalui email
                    </p>
                </div>
                <input
                    type="checkbox"
                    name="email_notification"
                    value="1"
                    class="rounded border-gray-300 text-[#0F5E3A] focus:ring-[#0F5E3A]/20 w-4.5 h-4.5 cursor-pointer"
                    checked
                >
            </div>

            <!-- Kegiatan -->
            <div class="border border-gray-100 rounded-2xl p-4 flex justify-between items-center bg-gray-50/50">
                <div>
                    <h3 class="text-[13px] font-bold text-gray-800">
                        Notifikasi Kegiatan
                    </h3>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">
                        Pemberitahuan kegiatan yang akan datang
                    </p>
                </div>
                <input
                    type="checkbox"
                    name="kegiatan_notification"
                    value="1"
                    class="rounded border-gray-300 text-[#0F5E3A] focus:ring-[#0F5E3A]/20 w-4.5 h-4.5 cursor-pointer"
                    checked
                >
            </div>

            <!-- Anggota -->
            <div class="border border-gray-100 rounded-2xl p-4 flex justify-between items-center bg-gray-50/50">
                <div>
                    <h3 class="text-[13px] font-bold text-gray-800">
                        Notifikasi Anggota Baru
                    </h3>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">
                        Dapatkan pemberitahuan saat ada anggota baru bergabung
                    </p>
                </div>
                <input
                    type="checkbox"
                    name="anggota_notification"
                    value="1"
                    class="rounded border-gray-300 text-[#0F5E3A] focus:ring-[#0F5E3A]/20 w-4.5 h-4.5 cursor-pointer"
                    checked
                >
            </div>

            <!-- PAC -->
            <div class="border border-gray-100 rounded-2xl p-4 flex justify-between items-center bg-gray-50/50">
                <div>
                    <h3 class="text-[13px] font-bold text-gray-800">
                        Notifikasi PAC
                    </h3>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">
                        Informasi perubahan data kepengurusan PAC
                    </p>
                </div>
                <input
                    type="checkbox"
                    name="pac_notification"
                    value="1"
                    class="rounded border-gray-300 text-[#0F5E3A] focus:ring-[#0F5E3A]/20 w-4.5 h-4.5 cursor-pointer"
                >
            </div>

        </div>

        <div class="flex justify-end mt-6 pt-5 border-t border-gray-50">
            <button
                type="submit"
                class="px-5 py-2.5 bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition text-white rounded-xl font-bold text-[13px] cursor-pointer"
            >
                Simpan Preferensi
            </button>
        </div>

    </form>

</div>