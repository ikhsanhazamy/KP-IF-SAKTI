<div
    id="modalTambahPAC"
    class="fixed inset-0 hidden items-center justify-center z-50 bg-black/50 backdrop-blur-sm p-4 overflow-y-auto"
>
    <div class="relative w-full max-w-[640px] rounded-2xl bg-white shadow-2xl border border-gray-100/80 overflow-hidden transform scale-95 transition-all duration-300">
        
        <!-- CLOSE -->
        <button
            onclick="closeTambahPACModal()"
            class="absolute top-5 right-5 w-8 h-8 rounded-full border border-gray-100 bg-white flex items-center justify-center text-gray-400 hover:text-gray-600 shadow-sm hover:shadow transition cursor-pointer"
            type="button"
        >
            &times;
        </button>

        <div class="px-6 py-5 border-b border-gray-50">
            <h2 class="text-[18px] font-bold text-gray-900 leading-tight">
                Tambah PAC Baru
            </h2>
            <p class="text-xs text-gray-400 mt-1 font-medium">
                Lengkapi semua informasi PAC yang akan didaftarkan
            </p>
        </div>

        <form action="/data-pac/store" method="POST" class="flex flex-col m-0">
            @csrf

            <div class="px-6 py-4 max-h-[calc(100vh-220px)] overflow-y-auto space-y-5">

                <!-- SECTION 1 -->
                <div>
                    <h3 class="text-[12px] font-bold text-[#0F5E3A] uppercase tracking-wider border-b border-gray-50 pb-1.5 mb-3.5">
                        Informasi Dasar PAC
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Nama PAC *</label>
                            <input
                                type="text"
                                name="nama_pac"
                                placeholder="Contoh: PAC Cibadak"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Kecamatan *</label>
                            <input
                                type="text"
                                name="kecamatan"
                                placeholder="Cibadak"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Status *</label>
                            <select
                                name="status"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150 bg-white"
                            >
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Tanggal Berdiri *</label>
                            <input
                                type="date"
                                name="tanggal_berdiri"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- SECTION 2 -->
                <div>
                    <h3 class="text-[12px] font-bold text-[#0F5E3A] uppercase tracking-wider border-b border-gray-50 pb-1.5 mb-3.5">
                        Alamat Lengkap
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Alamat Jalan *</label>
                            <input
                                type="text"
                                name="alamat"
                                placeholder="Contoh: Jl. Raya Cibadak No.123"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                required
                            >
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[13px] font-semibold text-gray-700 mb-1">Desa/Kelurahan *</label>
                                <input
                                    type="text"
                                    name="desa"
                                    placeholder="Nama desa"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                    required
                                >
                            </div>
                            <div>
                                <label class="block text-[13px] font-semibold text-gray-700 mb-1">Kode Pos</label>
                                <input
                                    type="text"
                                    name="kode_pos"
                                    placeholder="431xx"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3 -->
                <div>
                    <h3 class="text-[12px] font-bold text-[#0F5E3A] uppercase tracking-wider border-b border-gray-50 pb-1.5 mb-3.5">
                        Informasi Ketua PAC
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Nama Ketua *</label>
                            <input
                                type="text"
                                name="ketua_pac"
                                placeholder="Nama lengkap ketua"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">No. Telepon *</label>
                            <input
                                type="text"
                                name="telepon"
                                placeholder="08xxxxxxxx"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Email</label>
                            <input
                                type="email"
                                name="email"
                                placeholder="pac@email.com"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            >
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Nomor SK</label>
                            <input
                                type="text"
                                name="nomor_sk"
                                placeholder="Nomor SK kepengurusan"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            >
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Jumlah Anggota Awal</label>
                            <input
                                type="number"
                                name="jumlah_anggota"
                                placeholder="0"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            >
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1">Total Kegiatan Awal</label>
                            <input
                                type="number"
                                name="total_kegiatan"
                                value="0"
                                placeholder="0"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            >
                        </div>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1">Deskripsi/Keterangan</label>
                    <textarea
                        name="deskripsi"
                        rows="3"
                        placeholder="Keterangan tambahan..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150 resize-none"
                    ></textarea>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="px-6 py-4 border-t border-gray-50 flex justify-end gap-3 bg-gray-50/50">
                <button
                    type="button"
                    onclick="closeTambahPACModal()"
                    class="px-5 py-2.5 border border-gray-200 hover:bg-gray-50 transition text-gray-600 rounded-xl font-semibold text-[13px] cursor-pointer"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="px-5 py-2.5 bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition text-white rounded-xl font-bold text-[13px] cursor-pointer"
                >
                    Simpan PAC
                </button>
            </div>
        </form>
    </div>
</div>