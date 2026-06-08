<div
    id="modalTambah"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
>

    <div class="bg-white w-[720px] rounded-[28px] p-10 relative">

        <!-- CLOSE -->
        <button
            onclick="closeTambahModal()"
            class="absolute top-6 right-6 text-3xl text-gray-500"
        >
            ×
        </button>

        <h2 class="text-4xl font-bold mb-10">
            Tambah Anggota Baru
        </h2>

        <form action="/anggota/store" method="POST">

            @csrf

            <div class="space-y-6">

                <!-- NAMA -->
                <div>

                    <label class="block mb-2 font-medium">
                        Nama Lengkap *
                    </label>

                    <input
                        type="text"
                        name="nama"
                        placeholder="Hj. Nama Lengkap, S.Pd"
                        class="w-full border rounded-2xl px-5 py-4 outline-none"
                    >

                </div>

                <!-- GRID -->
                <div class="grid grid-cols-2 gap-5">

                    <div>

                        <label class="block mb-2 font-medium">
                            Email *
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="w-full border rounded-2xl px-5 py-4"
                        >

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            No. Telepon *
                        </label>

                        <input
                            type="text"
                            name="telepon"
                            class="w-full border rounded-2xl px-5 py-4"
                        >

                    </div>

                </div>

                <!-- GRID -->
                <div class="grid grid-cols-2 gap-5">

                    <div>

                        <label class="block mb-2 font-medium">
                            PAC *
                        </label>

                        <input
                            type="text"
                            name="pac"
                            class="w-full border rounded-2xl px-5 py-4"
                            required
                        >

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Profesi *
                        </label>

                        <input
                            type="text"
                            name="profesi"
                            class="w-full border rounded-2xl px-5 py-4"
                            required
                        >

                    </div>

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Pendidikan *
                    </label>

                    <select
                        name="pendidikan"
                        class="w-full border rounded-2xl px-5 py-4"
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
                <div class="grid grid-cols-2 gap-5">

                    <div>

                        <label class="block mb-2 font-medium">
                            Tanggal Bergabung *
                        </label>

                        <input
                            type="date"
                            name="tanggal_bergabung"
                            class="w-full border rounded-2xl px-5 py-4"
                        >

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Status *
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-2xl px-5 py-4"
                        >
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Tidak Aktif</option>
                        </select>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="grid grid-cols-2 gap-5 pt-4">

                    <button
                        type="button"
                        onclick="closeTambahModal()"
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
