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

        <div class="space-y-5">

            <div>
                <p class="text-gray-500">Nama PAC</p>
                <h3 id="detailNamaPAC" class="text-2xl font-semibold"></h3>
            </div>

            <div>
                <p class="text-gray-500">Kecamatan</p>
                <h3 id="detailKecamatan" class="text-xl"></h3>
            </div>

            <div>
                <p class="text-gray-500">Ketua PAC</p>
                <h3 id="detailKetua" class="text-xl"></h3>
            </div>

            <div>
                <p class="text-gray-500">Kontak</p>
                <h3 id="detailKontak" class="text-xl"></h3>
            </div>

        </div>

    </div>

</div>