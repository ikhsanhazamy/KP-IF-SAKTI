<div
    id="modalDetail"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
>

    <div class="bg-white w-full max-w-2xl rounded-3xl p-8">

        <div class="flex items-center justify-between mb-8">

            <h2 class="text-3xl font-bold">
                Detail Anggota
            </h2>

            <button
                onclick="closeDetailModal()"
                class="text-2xl"
            >
                ✕
            </button>

        </div>

        <div class="space-y-5">

            <div>
                <p class="text-gray-500">ID</p>
                <h3 id="detailId" class="text-xl font-semibold"></h3>
            </div>

            <div>
                <p class="text-gray-500">Nama</p>
                <h3 id="detailNama" class="text-xl font-semibold"></h3>
            </div>

            <div>
                <p class="text-gray-500">Email</p>
                <h3 id="detailEmail" class="text-xl"></h3>
            </div>

            <div>
                <p class="text-gray-500">Telepon</p>
                <h3 id="detailTelepon" class="text-xl"></h3>
            </div>

            <div>
                <p class="text-gray-500">PAC</p>
                <h3 id="detailPac" class="text-xl"></h3>
            </div>

            <div>
                <p class="text-gray-500">Profesi</p>
                <h3 id="detailProfesi" class="text-xl"></h3>
            </div>

            <div>
                <p class="text-gray-500">Tanggal Bergabung</p>
                <h3 id="detailTanggal" class="text-xl"></h3>
            </div>

            <div>
                <p class="text-gray-500 mb-2">Status</p>

                <span id="detailStatus"></span>
            </div>

        </div>

    </div>

</div>