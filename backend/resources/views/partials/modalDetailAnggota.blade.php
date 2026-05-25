<div
    id="modalDetail"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
>

    <div class="bg-white w-[760px] rounded-[30px] p-10 relative">

        <!-- CLOSE -->
        <button
            onclick="closeDetailModal()"
            class="absolute top-6 right-8 text-4xl text-gray-500 hover:text-black"
        >
            ×
        </button>

        <!-- TITLE -->
        <h2 class="text-4xl font-bold mb-10">
            Detail Anggota
        </h2>

        <!-- CONTENT -->
        <div class="grid grid-cols-2 gap-x-16 gap-y-10">

            <!-- NAMA -->
            <div>

                <p class="text-gray-500 mb-2">
                    Nama Lengkap
                </p>

                <h3
                    id="detailNama"
                    class="text-3xl font-semibold"
                >
                    -
                </h3>

            </div>

            <!-- STATUS -->
            <div>

                <p class="text-gray-500 mb-2">
                    Status
                </p>

                <span
                    id="detailStatus"
                    class="bg-green-100 text-[#15633D] px-5 py-2 rounded-full text-lg font-medium"
                >
                    Aktif
                </span>

            </div>

            <!-- EMAIL -->
            <div>

                <p class="text-gray-500 mb-2">
                    Email
                </p>

                <h3
                    id="detailEmail"
                    class="text-2xl"
                >
                    -
                </h3>

            </div>

            <!-- TELEPON -->
            <div>

                <p class="text-gray-500 mb-2">
                    No. Telepon
                </p>

                <h3
                    id="detailTelepon"
                    class="text-2xl"
                >
                    -
                </h3>

            </div>

            <!-- PAC -->
            <div>

                <p class="text-gray-500 mb-2">
                    PAC
                </p>

                <h3
                    id="detailPac"
                    class="text-2xl"
                >
                    -
                </h3>

            </div>

            <!-- PROFESI -->
            <div>

                <p class="text-gray-500 mb-2">
                    Profesi
                </p>

                <h3
                    id="detailProfesi"
                    class="text-2xl"
                >
                    -
                </h3>

            </div>

            <!-- TANGGAL -->
            <div>

                <p class="text-gray-500 mb-2">
                    Tanggal Bergabung
                </p>

                <h3
                    id="detailTanggal"
                    class="text-2xl"
                >
                    -
                </h3>

            </div>

            <!-- ID -->
            <div>

                <p class="text-gray-500 mb-2">
                    ID Anggota
                </p>

                <h3
                    id="detailId"
                    class="text-2xl font-bold"
                >
                    -
                </h3>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="grid grid-cols-2 gap-5 mt-12">

            <button
                class="bg-[#15633D] hover:bg-[#0F5E3A] text-white py-4 rounded-2xl text-xl font-medium transition"
            >
                Edit Data
            </button>

            <button
                onclick="closeDetailModal()"
                class="border border-gray-300 hover:bg-gray-100 py-4 rounded-2xl text-xl font-medium transition"
            >
                Tutup
            </button>

        </div>

    </div>

</div>