<div
    id="modalTambah"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4"
>

    <div class="bg-white w-full max-w-[560px] rounded-2xl p-7 relative shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">

        <!-- CLOSE -->
        <button
            onclick="closeTambahModal()"
            class="absolute top-5 right-5 w-8 h-8 rounded-full border border-gray-100 bg-white flex items-center justify-center text-gray-400 hover:text-gray-600 shadow-sm hover:shadow transition cursor-pointer"
        >
            &times;
        </button>

        <div class="mb-6">
            <h2 class="text-[18px] font-bold text-gray-900 leading-tight">
                Tambah Anggota Baru
            </h2>
            <p class="text-xs text-gray-400 mt-1 font-medium">
                Masukkan informasi data diri anggota baru
            </p>
        </div>

        <form action="/anggota/store" method="POST">
            @csrf

            <div class="space-y-4">

                <!-- NAMA -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                        Nama Lengkap *
                    </label>
                    <input
                        type="text"
                        name="nama"
                        placeholder="Masukkan nama lengkap"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                        required
                    >
                </div>

                <!-- GRID: Email & Telepon -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Email *
                        </label>
                        <input
                            type="email"
                            name="email"
                            placeholder="nama@email.com"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            No. Telepon *
                        </label>
                        <input
                            type="text"
                            name="telepon"
                            placeholder="0812xxxx"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                </div>

                <!-- GRID: PAC & Profesi -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            PAC *
                        </label>
                        <input
                            type="text"
                            name="pac"
                            placeholder="Nama kecamatan"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Profesi *
                        </label>
                        <input
                            type="text"
                            name="profesi"
                            placeholder="Pekerjaan"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                </div>

                <!-- PENDIDIKAN -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                        Pendidikan *
                    </label>
                    <select
                        name="pendidikan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150 bg-white"
                        required
                    >
                        <option value="">Pilih Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
                
                <!-- GRID: Tanggel Bergabung & Status -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Tanggal Bergabung *
                        </label>
                        <input
                            type="date"
                            name="tanggal_bergabung"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Status *
                        </label>
                        <select
                            name="status"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150 bg-white"
                        >
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-50 mt-6">
                    <button
                        type="button"
                        onclick="closeTambahModal()"
                        class="px-5 py-2.5 border border-gray-200 hover:bg-gray-50 transition text-gray-600 rounded-xl font-semibold text-[13px] cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition text-white rounded-xl font-bold text-[13px] cursor-pointer"
                    >
                        Simpan
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>
