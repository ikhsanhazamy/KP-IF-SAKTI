<div
    id="modalEditPAC"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-6"
>

    <div class="bg-white w-full max-w-2xl rounded-3xl p-8 relative">

        <button
            onclick="closeEditPACModal()"
            class="absolute top-5 right-5 text-3xl"
        >
            ×
        </button>

        <h2 class="text-3xl font-bold mb-8">
            Edit PAC
        </h2>

        <form id="formEditPAC" method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-5">

                <div>
                    <label class="block mb-2">Nama PAC</label>

                    <input
                        type="text"
                        name="nama_pac"
                        id="editNamaPAC"
                        class="w-full border rounded-2xl px-5 py-4"
                    >
                </div>

                <div>
                    <label class="block mb-2">Kecamatan</label>

                    <input
                        type="text"
                        name="kecamatan"
                        id="editKecamatan"
                        class="w-full border rounded-2xl px-5 py-4"
                    >
                </div>

                <div>
                    <label class="block mb-2">Ketua PAC</label>

                    <input
                        type="text"
                        name="ketua"
                        id="editKetua"
                        class="w-full border rounded-2xl px-5 py-4"
                    >
                </div>

                <div>
                    <label class="block mb-2">Kontak</label>

                    <input
                        type="text"
                        name="telepon   "
                        id="edittelepon"
                        class="w-full border rounded-2xl px-5 py-4"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-[#15633D] text-white rounded-2xl py-4"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>