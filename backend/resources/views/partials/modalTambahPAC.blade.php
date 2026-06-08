<div
    id="modalTambahPAC"
    class="fixed inset-0 hidden items-start justify-center z-50 bg-black/50 p-6 overflow-y-auto"
>
    <div class="relative w-full max-w-[896px] rounded-[16px] bg-white shadow-2xl">
        <div class="flex flex-col">
            <div class="flex items-center justify-between border-b border-[#E5E7EB] px-8 py-6">
                <div class="space-y-1">
                    <h2 class="text-[24px] font-bold leading-8 text-[#1D1D1D]">
                        Tambah PAC Baru
                    </h2>
                    <p class="text-sm text-[#717182]">
                        Lengkapi semua informasi PAC yang akan didaftarkan
                    </p>
                </div>

                <button
                    onclick="closeTambahPACModal()"
                    class="flex h-10 w-10 items-center justify-center rounded-[12px] text-[24px] text-[#1D1D1D] hover:bg-[#F5F7F8]"
                    type="button"
                >
                    ×
                </button>
            </div>

            <form action="/data-pac/store" method="POST" class="flex flex-col">
                @csrf

                <div class="space-y-8 px-8 pt-6 pb-6 max-h-[calc(100vh-300px)] overflow-y-auto">

                    <div class="space-y-3">
                        <div>
                            <h3 class="text-[18px] font-semibold text-[#1D1D1D]">Informasi Dasar PAC</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Nama PAC</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="nama_pac"
                                    placeholder="Contoh: PAC Cibadak"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Kecamatan</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="kecamatan"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Status</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <select
                                    name="status"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Tanggal Berdiri</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="date"
                                    name="tanggal_berdiri"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <h3 class="text-[18px] font-semibold text-[#1D1D1D]">Alamat Lengkap</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Alamat Jalan</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="alamat"
                                    placeholder="Contoh: Jl. Raya Cibadak No.123"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                        <span>Desa/Kelurahan</span>
                                        <span class="text-[#D4183D]">*</span>
                                    </div>
                                    <input
                                        type="text"
                                        name="desa"
                                        class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                    >
                                </div>
                                <div class="space-y-2">
                                    <div class="text-sm font-medium text-[#1D1D1D]">Kode Pos</div>
                                    <input
                                        type="text"
                                        name="kode_pos"
                                        class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <h3 class="text-[18px] font-semibold text-[#1D1D1D]">Informasi Ketua PAC</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Nama Ketua</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="ketua"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>No. Telepon</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="telepon"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Email</div>
                                <input
                                    type="email"
                                    name="email"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Jumlah Anggota Awal</div>
                                <input
                                    type="number"
                                    name="jumlah_anggota"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Nomor SK</div>
                                <input
                                    type="text"
                                    name="nomor_sk"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Total Kegiatan Awal</div>
                                <input
                                    type="number"
                                    name="total_kegiatan"
                                    value="0"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="text-sm font-medium text-[#1D1D1D]">Deskripsi/Keterangan</div>
                        <textarea
                            name="deskripsi"
                            rows="5"
                            class="h-[114px] w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 py-3 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A] resize-none"
                        ></textarea>
                    </div>

                </div>

                <div class="border-t border-[#E5E7EB] bg-white px-8 py-6">
                    <div class="grid grid-cols-2 gap-4">
                        <button
                            type="button"
                            onclick="closeTambahPACModal()"
                            class="flex h-12 items-center justify-center rounded-[12px] border border-[#E5E7EB] text-sm font-medium text-[#1D1D1D]"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="flex h-12 items-center justify-center rounded-[12px] bg-[#0F5E3A] text-sm font-medium text-white transition hover:bg-[#15633D]"
                        >
                            Simpan PAC
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>