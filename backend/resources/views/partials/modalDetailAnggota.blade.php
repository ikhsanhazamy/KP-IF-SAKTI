<div
    id="modalDetail"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4"
>

    <div class="bg-white w-full max-w-[480px] rounded-2xl p-7 relative shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">

        <!-- CLOSE -->
        <button
            onclick="closeDetailModal()"
            class="absolute top-5 right-5 w-8 h-8 rounded-full border border-gray-100 bg-white flex items-center justify-center text-gray-400 hover:text-gray-600 shadow-sm hover:shadow transition cursor-pointer"
        >
            &times;
        </button>

        <div class="mb-6 border-b border-gray-50 pb-4">
            <h2 class="text-[18px] font-bold text-gray-900 leading-tight">
                Detail Anggota
            </h2>
            <p class="text-xs text-gray-400 mt-1 font-medium">
                Informasi profil lengkap anggota Fatayat NU
            </p>
        </div>

        <div class="space-y-4">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">ID Anggota</p>
                    <h3 id="detailId" class="text-[13px] font-semibold text-gray-800 mt-1"></h3>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status</p>
                    <div id="detailStatus" class="mt-1"></div>
                </div>
            </div>

            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nama Lengkap</p>
                <h3 id="detailNama" class="text-[14px] font-bold text-gray-900 mt-1"></h3>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Email</p>
                    <h3 id="detailEmail" class="text-[13px] font-medium text-gray-700 mt-1 break-all"></h3>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">No. Telepon</p>
                    <h3 id="detailTelepon" class="text-[13px] font-medium text-gray-700 mt-1"></h3>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">PAC Kecamatan</p>
                    <h3 id="detailPac" class="text-[13px] font-medium text-gray-700 mt-1"></h3>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Pendidikan</p>
                    <h3 id="detailPendidikan" class="text-[13px] font-medium text-gray-700 mt-1"></h3>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Profesi</p>
                    <h3 id="detailProfesi" class="text-[13px] font-medium text-gray-700 mt-1"></h3>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Bergabung</p>
                    <h3 id="detailTanggal" class="text-[13px] font-medium text-gray-700 mt-1"></h3>
                </div>
            </div>

        </div>

        <div class="flex items-center justify-end pt-5 border-t border-gray-50 mt-6">
            <button
                onclick="closeDetailModal()"
                class="px-5 py-2 border border-gray-200 hover:bg-gray-50 transition text-gray-600 rounded-xl font-semibold text-[13px] cursor-pointer"
            >
                Tutup
            </button>
        </div>

    </div>

</div>