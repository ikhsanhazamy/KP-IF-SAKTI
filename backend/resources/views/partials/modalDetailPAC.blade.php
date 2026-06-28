<div
    id="modalDetailPAC"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4"
>

    <div class="bg-white w-full max-w-[480px] rounded-2xl p-7 relative shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">

        <!-- CLOSE -->
        <button
            onclick="closeDetailPACModal()"
            class="absolute top-5 right-5 w-8 h-8 rounded-full border border-gray-100 bg-white flex items-center justify-center text-gray-400 hover:text-gray-600 shadow-sm hover:shadow transition cursor-pointer"
        >
            &times;
        </button>

        <div class="mb-6 border-b border-gray-50 pb-4">
            <h2 class="text-[18px] font-bold text-gray-900 leading-tight">
                Detail PAC
            </h2>
            <p class="text-xs text-gray-400 mt-1 font-medium">
                Informasi detail kepengurusan Pimpinan Anak Cabang
            </p>
        </div>

        <div class="space-y-5">

            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Nama PAC</p>
                <h3 id="detailNamaPAC" class="text-[15px] font-bold text-gray-900 mt-0.5"></h3>
            </div>

            <!-- GRID STATS -->
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-3 text-center">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Anggota</p>
                    <h3 id="detailJumlahAnggota" class="text-lg font-bold text-[#0F5E3A] mt-1"></h3>
                </div>
                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-3 text-center">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Growth</p>
                    <h3 id="detailPertumbuhan" class="text-lg font-bold text-[#0F5E3A] mt-1"></h3>
                </div>
                <div class="bg-gray-50/50 border border-gray-50 rounded-xl p-3 text-center">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Kegiatan</p>
                    <h3 id="detailTotalKegiatan" class="text-lg font-bold text-[#0F5E3A] mt-1"></h3>
                </div>
            </div>

            <div class="border-t border-gray-50 pt-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Kecamatan</p>
                        <h3 id="detailKecamatan" class="text-[13px] font-semibold text-gray-800 mt-0.5"></h3>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Ketua PAC</p>
                        <h3 id="detailKetua" class="text-[13px] font-semibold text-gray-800 mt-0.5"></h3>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Kontak Telepon</p>
                        <h3 id="detailKontak" class="text-[13px] font-semibold text-gray-800 mt-0.5"></h3>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Nomor SK</p>
                        <h3 id="detailNomorSK" class="text-[13px] font-semibold text-gray-800 mt-0.5"></h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex items-center justify-end pt-5 border-t border-gray-50 mt-6">
            <button
                onclick="closeDetailPACModal()"
                class="px-5 py-2 border border-gray-200 hover:bg-gray-50 transition text-gray-600 rounded-xl font-semibold text-[13px] cursor-pointer"
            >
                Tutup
            </button>
        </div>

    </div>

</div>