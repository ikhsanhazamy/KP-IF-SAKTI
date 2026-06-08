<div class="bg-white rounded-2xl border border-gray-200 p-6">

    <h2 class="text-[20px] font-bold text-[#1D1D1D] mb-6">
        Pengaturan Sistem
    </h2>

    <!-- FORM PENGATURAN -->
    <form
        id="pengaturanForm"
        method="POST"
        action="{{ route('pengaturan.update') }}"
    >
        @csrf

        <div class="space-y-4">

            <!-- Bahasa -->
            <div>
                <label class="block text-sm font-medium text-[#1D1D1D] mb-2">
                    Bahasa
                </label>

                <select
                    name="language"
                    class="w-full h-10 px-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                >
                    <option value="id">
                        Bahasa Indonesia
                    </option>

                    <option value="en">
                        English
                    </option>
                </select>
            </div>

            <!-- Zona Waktu -->
            <div>
                <label class="block text-sm font-medium text-[#1D1D1D] mb-2">
                    Zona Waktu
                </label>

                <select
                    name="timezone"
                    class="w-full h-10 px-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                >
                    <option value="Asia/Jakarta">
                        Asia/Jakarta (WIB)
                    </option>

                    <option value="Asia/Makassar">
                        Asia/Makassar (WITA)
                    </option>

                    <option value="Asia/Jayapura">
                        Asia/Jayapura (WIT)
                    </option>
                </select>
            </div>

            <!-- Format Tanggal -->
            <div>
                <label class="block text-sm font-medium text-[#1D1D1D] mb-2">
                    Format Tanggal
                </label>

                <select
                    name="date_format"
                    class="w-full h-10 px-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                >
                    <option value="d-m-Y">
                        DD-MM-YYYY
                    </option>

                    <option value="Y-m-d">
                        YYYY-MM-DD
                    </option>

                    <option value="d/m/Y">
                        DD/MM/YYYY
                    </option>
                </select>
            </div>

        </div>

    </form>

    <!-- Backup & Restore -->
    <div class="border-t border-gray-200 mt-6 pt-6">

        <h3 class="text-[18px] font-bold text-[#1D1D1D] mb-4">
            Backup & Restore
        </h3>

        <div class="grid md:grid-cols-2 gap-4">

            <!-- Backup -->
            <form
                action="{{ route('backup.database') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full h-[50px] border border-gray-200 rounded-xl text-[16px] font-medium text-[#1D1D1D] hover:bg-gray-50 transition"
                >
                    Backup Database
                </button>
            </form>

            <!-- Restore -->
            <form
                action="{{ route('restore.database') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full h-[50px] border border-gray-200 rounded-xl text-[16px] font-medium text-[#1D1D1D] hover:bg-gray-50 transition"
                >
                    Restore Database
                </button>
            </form>

        </div>

    </div>

    <!-- Tombol Simpan -->
    <div class="flex justify-end mt-6">

        <button
            type="submit"
            form="pengaturanForm"
            class="h-10 px-6 bg-[#0F5E3A] text-white rounded-xl font-medium hover:bg-[#15633D] transition"
        >
            Simpan Pengaturan
        </button>

    </div>

</div>