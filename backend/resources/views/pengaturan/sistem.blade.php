<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

    <h2 class="text-[16px] font-bold text-gray-900 mb-6 pb-2 border-b border-gray-50">
        Pengaturan Sistem
    </h2>

    <!-- FORM PENGATURAN -->
    <form
        id="pengaturanForm"
        method="POST"
        action="{{ route('pengaturan.update') }}"
        class="m-0"
    >
        @csrf

        <div class="space-y-4">

            <!-- Bahasa -->
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Bahasa
                </label>
                <select
                    name="language"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition bg-white"
                >
                    <option value="id">Bahasa Indonesia</option>
                    <option value="en">English</option>
                </select>
            </div>

            <!-- Zona Waktu -->
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Zona Waktu
                </label>
                <select
                    name="timezone"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition bg-white"
                >
                    <option value="Asia/Jakarta">Asia/Jakarta (WIB)</option>
                    <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                    <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                </select>
            </div>

            <!-- Format Tanggal -->
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Format Tanggal
                </label>
                <select
                    name="date_format"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition bg-white"
                >
                    <option value="d-m-Y">DD-MM-YYYY</option>
                    <option value="Y-m-d">YYYY-MM-DD</option>
                    <option value="d/m/Y">DD/MM/YYYY</option>
                </select>
            </div>

        </div>

    </form>

    <!-- Backup & Restore -->
    <div class="border-t border-gray-50 mt-6 pt-6">

        <h3 class="text-[14px] font-bold text-gray-800 mb-4">
            Backup & Restore
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <!-- Backup -->
            <form
                action="{{ route('backup.database') }}"
                method="POST"
                class="m-0"
            >
                @csrf
                <button
                    type="submit"
                    class="w-full border border-gray-200 hover:bg-gray-50 bg-white transition text-gray-700 py-2.5 rounded-xl text-xs font-semibold shadow-sm flex items-center justify-center cursor-pointer"
                >
                    Backup Database
                </button>
            </form>

            <!-- Restore -->
            <form
                action="{{ route('restore.database') }}"
                method="POST"
                enctype="multipart/form-data"
                class="m-0"
            >
                @csrf
                <div class="flex flex-col gap-3">
                    <input
                        type="file"
                        name="backup_file"
                        required
                        class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200"
                    >
                    <button
                        type="submit"
                        class="w-full border border-gray-200 hover:bg-gray-50 bg-white transition text-gray-700 py-2.5 rounded-xl text-xs font-semibold shadow-sm flex items-center justify-center cursor-pointer"
                    >
                        Restore Database
                    </button>
                </div>
            </form>

        </div>

    </div>

    <!-- Tombol Simpan -->
    <div class="flex justify-end mt-6 pt-5 border-t border-gray-50">
        <button
            type="submit"
            form="pengaturanForm"
            class="px-5 py-2.5 bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition text-white rounded-xl font-bold text-[13px] cursor-pointer"
        >
            Simpan Pengaturan
        </button>
    </div>

</div>