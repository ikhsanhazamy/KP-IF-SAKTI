<div
    id="modalTambahPAC"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-6"
>

    <div class="bg-white w-full max-w-5xl rounded-[32px] overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-start justify-between p-8 border-b">

            <div>

                <h2 class="text-4xl font-bold mb-2">
                    Tambah PAC Baru
                </h2>

                <p class="text-[#717182]">
                    Lengkapi semua informasi PAC yang akan didaftarkan
                </p>

            </div>

            <button
                onclick="closeTambahPACModal()"
                class="text-4xl text-[#717182]"
            >
                ×
            </button>

        </div>

        <!-- BODY -->
        <form
            action="/pac/store"
            method="POST"
            class="p-8 overflow-y-auto max-h-[75vh]"
        >

            @csrf

            <div class="space-y-10">

                <!-- INFORMASI PAC -->
                <div>

                    <h3 class="text-2xl font-semibold mb-6">
                        Informasi Dasar PAC
                    </h3>

                    <div class="grid grid-cols-2 gap-6">

                        <div>
                            <label class="block mb-2 font-medium">
                                Nama PAC *
                            </label>

                            <input
                                type="text"
                                name="nama_pac"
                                placeholder="Contoh: PAC Cibadak"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Kecamatan *
                            </label>

                            <input
                                type="text"
                                name="kecamatan"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Status *
                            </label>

                            <select
                                name="status"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                                <option value="aktif">
                                    Aktif
                                </option>

                                <option value="tidak_aktif">
                                    Tidak Aktif
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Tanggal Berdiri *
                            </label>

                            <input
                                type="date"
                                name="tanggal_berdiri"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                    </div>

                </div>

                <!-- ALAMAT -->
                <div>

                    <h3 class="text-2xl font-semibold mb-6">
                        Alamat Lengkap
                    </h3>

                    <div class="space-y-6">

                        <div>
                            <label class="block mb-2 font-medium">
                                Alamat Jalan *
                            </label>

                            <input
                                type="text"
                                name="alamat"
                                placeholder="Contoh: Jl. Raya Cibadak No.123"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                        <div class="grid grid-cols-2 gap-6">

                            <div>
                                <label class="block mb-2 font-medium">
                                    Desa/Kelurahan *
                                </label>

                                <input
                                    type="text"
                                    name="desa"
                                    class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                                >
                            </div>

                            <div>
                                <label class="block mb-2 font-medium">
                                    Kode Pos
                                </label>

                                <input
                                    type="text"
                                    name="kode_pos"
                                    class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                                >
                            </div>

                        </div>

                    </div>

                </div>

                <!-- KETUA PAC -->
                <div>

                    <h3 class="text-2xl font-semibold mb-6">
                        Informasi Ketua PAC
                    </h3>

                    <div class="grid grid-cols-2 gap-6">

                        <div>
                            <label class="block mb-2 font-medium">
                                Nama Ketua *
                            </label>

                            <input
                                type="text"
                                name="ketua"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                No. Telepon *
                            </label>

                            <input
                                type="text"
                                name="telepon"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Jumlah Anggota Awal
                            </label>

                            <input
                                type="number"
                                name="jumlah_anggota"
                                class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none"
                            >
                        </div>

                    </div>

                </div>

                <!-- DESKRIPSI -->
                <div>

                    <label class="block mb-2 font-medium">
                        Deskripsi/Keterangan
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="w-full border border-[#E5E7EB] rounded-2xl px-5 py-4 outline-none resize-none"
                    ></textarea>

                </div>

                <!-- BUTTON -->
                <div class="grid grid-cols-2 gap-6 pt-4 border-t">

                    <button
                        type="button"
                        onclick="closeTambahPACModal()"
                        class="border border-[#E5E7EB] rounded-2xl py-4 text-lg"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="bg-[#15633D] hover:bg-[#0F5E3A] text-white rounded-2xl py-4 text-lg transition"
                    >
                        Simpan PAC
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>