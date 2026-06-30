<div
    id="modalDetailPAC"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-6"
>

    <div class="bg-white w-full max-w-2xl rounded-3xl p-8 relative">

        <button
            onclick="closeDetailPACModal()"
            class="absolute top-5 right-5 text-3xl"
        >
            ×
        </button>

        <h2 class="text-3xl font-bold mb-8">
            Detail PAC
        </h2>

        <div class="space-y-6">

            <div>
                <p class="text-gray-500 text-sm">Nama PAC</p>
                <h3 id="detailNamaPAC" class="text-2xl font-semibold"></h3>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="bg-gray-50 rounded-2xl p-4">
                    <p class="text-gray-500 text-sm">Total Anggota</p>
                    <h3 id="detailJumlahAnggota" class="text-2xl font-bold text-[#15633D] mt-2"></h3>
                </div>
                <div class="bg-gray-50 rounded-2xl p-4">
                    <p class="text-gray-500 text-sm">Pertumbuhan</p>
                    <h3 id="detailPertumbuhan" class="text-2xl font-bold text-green-600 mt-2"></h3>
                </div>
                <div class="bg-gray-50 rounded-2xl p-4">
                    <p class="text-gray-500 text-sm">Alumni LKD</p>
                    <h3 id="detailAlumniLKD" class="text-2xl font-bold text-[#15633D] mt-2"></h3>
                </div>
            </div>

            <div class="border-t pt-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-500 text-sm">Kecamatan</p>
                        <h3 id="detailKecamatan" class="text-lg font-semibold mt-1"></h3>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Ketua PAC</p>
                        <h3 id="detailKetua" class="text-lg font-semibold mt-1"></h3>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Kontak</p>
                        <h3 id="detailKontak" class="text-lg font-semibold mt-1"></h3>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Nomor SK</p>
                        <h3 id="detailNomorSK" class="text-lg font-semibold mt-1"></h3>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
