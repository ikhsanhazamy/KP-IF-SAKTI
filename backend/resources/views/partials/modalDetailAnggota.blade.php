z<div id="modalDetail" class="fixed inset-0 z-[100] hidden items-start justify-center overflow-y-auto bg-black/40 p-4 sm:p-6">
    <div class="my-auto max-h-[calc(100vh-2rem)] w-full max-w-2xl overflow-y-auto rounded-3xl bg-white p-6 sm:p-8">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-3xl font-bold">Detail Anggota</h2>
            <button type="button" onclick="closeDetailModal()" class="text-3xl text-gray-400 hover:text-black">
                &times;
            </button>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
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
                <p class="text-gray-500">Pendidikan</p>
                <h3 id="detailPendidikan" class="text-xl"></h3>
            </div>
            <div>
                <p class="text-gray-500">Tanggal Lahir</p>
                <h3 id="detailTanggalLahir" class="text-xl"></h3>
            </div>
            <div>
                <p class="text-gray-500">Umur</p>
                <h3 id="detailUmur" class="text-xl"></h3>
            </div>
            <div>
                <p class="text-gray-500">Tanggal Bergabung</p>
                <h3 id="detailTanggal" class="text-xl"></h3>
            </div>
            <div>
                <p class="mb-2 text-gray-500">Status</p>
                <span id="detailStatus"></span>
            </div>
            <div>
                <p class="text-gray-500">Status Pernikahan</p>
                <h3 id="detailStatusPernikahan" class="text-xl"></h3>
            </div>
        </div>
    </div>
</div>
