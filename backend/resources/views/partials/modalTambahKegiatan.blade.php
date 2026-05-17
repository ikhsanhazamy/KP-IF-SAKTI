<div
    id="modalTambahKegiatan"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-6"
>

    <div class="bg-white w-full max-w-4xl rounded-[32px] shadow-xl overflow-hidden">

        <div class="max-h-[90vh] overflow-y-auto p-8 relative">

            <!-- CLOSE -->
            <button
                onclick="closeTambahKegiatanModal()"
                class="absolute top-6 right-6 text-3xl text-gray-500"
            >
                ×
            </button>

            <h2 class="text-4xl font-bold mb-8">
                Tambah Kegiatan Baru
            </h2>

            <form action="/kegiatan/store" method="POST">

                @csrf

                <div class="space-y-5">

                    <!-- JUDUL -->
                    <div>

                        <label class="block mb-2 font-medium">
                            Judul Kegiatan
                        </label>

                        <input
                            type="text"
                            name="judul"
                            placeholder="Masukkan judul kegiatan"
                            class="w-full border rounded-2xl px-5 py-4 outline-none"
                        >

                    </div>

                    <!-- GRID -->
                    <div class="grid grid-cols-2 gap-5">

                        <div>

                            <label class="block mb-2 font-medium">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                class="w-full border rounded-2xl px-5 py-4"
                            >

                        </div>

                        <div>

                            <label class="block mb-2 font-medium">
                                Waktu
                            </label>

                            <input
                                type="time"
                                name="waktu"
                                class="w-full border rounded-2xl px-5 py-4"
                            >

                        </div>

                    </div>

                    <!-- LOKASI -->
                    <div>

                        <label class="block mb-2 font-medium">
                            Lokasi
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            placeholder="Masukkan lokasi kegiatan"
                            class="w-full border rounded-2xl px-5 py-4"
                        >

                    </div>

                    <!-- GRID -->
                    <div class="grid grid-cols-2 gap-5">

                        <div>

                            <label class="block mb-2 font-medium">
                                Kategori
                            </label>

                            <input
                                type="text"
                                name="kategori"
                                placeholder="Seminar, Workshop, dll"
                                class="w-full border rounded-2xl px-5 py-4"
                            >

                        </div>

                        <div>

                            <label class="block mb-2 font-medium">
                                Estimasi Peserta
                            </label>

                            <input
                                type="number"
                                name="peserta"
                                placeholder="100"
                                class="w-full border rounded-2xl px-5 py-4"
                            >

                        </div>

                    </div>

                    <!-- STATUS -->
                    <div>

                        <label class="block mb-2 font-medium">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-2xl px-5 py-4"
                        >

                            <option value="upcoming">
                                Upcoming
                            </option>

                            <option value="ongoing">
                                Ongoing
                            </option>

                            <option value="completed">
                                Completed
                            </option>

                        </select>

                    </div>

                    <!-- DESKRIPSI -->
                    <div>

                        <label class="block mb-2 font-medium">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="4"
                            placeholder="Masukkan deskripsi kegiatan"
                            class="w-full border rounded-2xl px-5 py-4 resize-none"
                        ></textarea>

                    </div>

                    <!-- BUTTON -->
                    <div class="sticky bottom-0 bg-white pt-4 grid grid-cols-2 gap-5">

                        <button
                            type="button"
                            onclick="closeTambahKegiatanModal()"
                            class="border rounded-2xl py-4"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="bg-[#15633D] text-white rounded-2xl py-4"
                        >
                            Simpan
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>