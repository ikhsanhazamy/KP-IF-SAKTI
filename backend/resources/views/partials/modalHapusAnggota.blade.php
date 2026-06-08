<div
    id="modalHapus"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
>

    <div class="bg-white w-full max-w-lg rounded-3xl p-8">

        <h2 class="text-3xl font-bold mb-5">
            Hapus Anggota
        </h2>

        <p
            id="hapusText"
            class="text-gray-600 mb-8"
        ></p>

        <div class="flex justify-end gap-4">

            <button
                onclick="closeDeleteModal()"
                class="px-6 py-3 border rounded-2xl"
            >
                Batal
            </button>

            <form
                id="formDeleteAnggota"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="bg-red-500 text-white px-6 py-3 rounded-2xl"
                >
                    Hapus
                </button>

            </form>

        </div>

    </div>

</div>