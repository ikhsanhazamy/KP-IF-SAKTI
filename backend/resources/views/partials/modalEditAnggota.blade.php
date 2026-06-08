<div
    id="modalEdit"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 overflow-y-auto p-6"
>

    <div class="bg-white w-full max-w-3xl rounded-3xl p-8 my-10">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-8">

            <div>

                <h2 class="text-3xl font-bold text-[#1E1E1E]">
                    Edit Anggota
                </h2>

                <p class="text-gray-500 mt-2">
                    Perbarui data anggota Fatayat NU
                </p>

            </div>

            <button
                onclick="closeEditModal()"
                class="text-3xl text-gray-400 hover:text-black transition"
            >
                ✕
            </button>

        </div>

        <!-- FORM -->
        <form
            id="formEditAnggota"
            method="POST"
            class="space-y-6"
        >

            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div>

                <label class="block text-lg font-medium mb-3">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="nama"
                    id="editNama"
                    class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                    required
                >

            </div>

            <!-- EMAIL -->
            <div>

                <label class="block text-lg font-medium mb-3">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="editEmail"
                    class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                    required
                >

            </div>

            <!-- TELEPON -->
            <div>

                <label class="block text-lg font-medium mb-3">
                    Nomor Telepon
                </label>

                <input
                    type="text"
                    name="telepon"
                    id="editTelepon"
                    class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                    required
                >

            </div>

            <!-- GRID -->
            <div class="grid grid-cols-2 gap-6">

                <!-- PAC -->
                <div>

                    <label class="block text-lg font-medium mb-3">
                        PAC
                    </label>

                    <input
                        type="text"
                        name="pac"
                        id="editPac"
                        class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                        required
                    >

                </div>

                <!-- PROFESI -->
                <div>

                    <label class="block text-lg font-medium mb-3">
                        Profesi
                    </label>

                    <input
                        type="text"
                        name="profesi"
                        id="editProfesi"
                        class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                        required
                    >

                </div>

            </div>

            <!-- PENDIDIKAN -->
            <div>

                <label class="block text-lg font-medium mb-3">
                    Pendidikan
                </label>

                <select
                    name="pendidikan"
                    id="editPendidikan"
                    class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                    required
                >
                    <option value="">Pilih Pendidikan</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>

            </div>

            <!-- GRID -->
            <div class="grid grid-cols-2 gap-6">

                <!-- TANGGAL -->
                <div>

                    <label class="block text-lg font-medium mb-3">
                        Tanggal Bergabung
                    </label>

                    <input
                        type="date"
                        name="tanggal_bergabung"
                        id="editTanggal"
                        class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                        required
                    >

                </div>

                <!-- STATUS -->
                <div>

                    <label class="block text-lg font-medium mb-3">
                        Status
                    </label>

                    <select
                        name="status"
                        id="editStatus"
                        class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/10"
                    >

                        <option value="aktif">
                            Aktif
                        </option>

                        <option value="tidak_aktif">
                            Tidak Aktif
                        </option>

                    </select>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-4 pt-4">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="px-8 py-4 rounded-2xl border border-gray-200 hover:bg-gray-50 transition"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="bg-[#15633D] hover:bg-[#0F5E3A] text-white px-8 py-4 rounded-2xl transition"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>