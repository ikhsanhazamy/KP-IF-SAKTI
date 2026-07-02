<div
    id="modalTambahKegiatan"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4"
>

    <div class="bg-white w-full max-w-[560px] max-h-[calc(100vh-2rem)] overflow-y-auto rounded-2xl p-7 relative shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">

        <!-- CLOSE -->
        <button
            onclick="closeTambahKegiatanModal()"
            class="absolute top-5 right-5 w-8 h-8 rounded-full border border-gray-100 bg-white flex items-center justify-center text-gray-400 hover:text-gray-600 shadow-sm hover:shadow transition cursor-pointer"
            type="button"
        >
            &times;
        </button>

        <div class="mb-6">
            <h2 id="kegiatanModalTitle" class="text-[18px] font-bold text-gray-900 leading-tight">
                Tambah Kegiatan Baru
            </h2>
            <p class="text-xs text-gray-400 mt-1 font-medium">
                Masukkan detail data kegiatan atau program organisasi
            </p>
        </div>

        <form id="kegiatanForm" action="/kegiatan/store" method="POST" enctype="multipart/form-data" class="m-0">
            @csrf
            <input type="hidden" name="_method" id="kegiatanMethod" value="POST">

            <div class="space-y-4">

                <!-- JUDUL -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                        Judul Kegiatan *
                    </label>
                    <input
                        id="judul"
                        type="text"
                        name="judul"
                        placeholder="Masukkan judul kegiatan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                        required
                    >
                </div>

                <!-- GRID: Tanggal & Waktu -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Tanggal *
                        </label>
                        <input
                            id="tanggal"
                            type="date"
                            name="tanggal"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Waktu *
                        </label>
                        <input
                            id="waktu"
                            type="time"
                            name="waktu"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                </div>

                <!-- LOKASI -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                        Lokasi *
                    </label>
                    <input
                        id="lokasi"
                        type="text"
                        name="lokasi"
                        placeholder="Masukkan lokasi kegiatan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                        required
                    >
                </div>

                <!-- GRID: Kategori & Estimasi Peserta -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Kategori *
                        </label>
                        <input
                            id="kategori"
                            type="text"
                            name="kategori"
                            placeholder="Seminar, Workshop, dll"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                            Estimasi Peserta *
                        </label>
                        <input
                            id="peserta"
                            type="number"
                            name="peserta"
                            placeholder="100"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>
                </div>

                <!-- STATUS -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                        Status *
                    </label>
                    <select
                        id="status"
                        name="status"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150 bg-white"
                    >
                        <option value="upcoming">Upcoming</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <!-- GAMBAR -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                        Gambar Kegiatan
                    </label>
                    <input
                        id="gambar"
                        type="file"
                        name="gambar"
                        accept="image/jpeg,image/png,image/webp"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 file:mr-4 file:rounded-lg file:border-0 file:bg-[#EDF7F0] file:px-3 file:py-1.5 file:text-[12px] file:font-semibold file:text-[#15633D] focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                    >
                    <p class="mt-1 text-[11px] text-gray-400">
                        JPG, PNG, atau WebP maksimal 5MB. Gambar akan dikompres otomatis.
                    </p>
                    <div id="gambarPreviewWrapper" class="mt-3 hidden overflow-hidden rounded-xl border border-gray-100 bg-gray-50">
                        <img id="gambarPreview" src="" alt="Preview gambar kegiatan" class="h-36 w-full object-cover">
                    </div>
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                        Deskripsi
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="3"
                        placeholder="Masukkan deskripsi kegiatan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150 resize-none"
                    ></textarea>
                </div>

                <!-- ACTIONS -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-50 mt-6">
                    <button
                        type="button"
                        onclick="closeTambahKegiatanModal()"
                        class="px-5 py-2.5 border border-gray-200 hover:bg-gray-50 transition text-gray-600 rounded-xl font-semibold text-[13px] cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        id="kegiatanSubmitButton"
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
