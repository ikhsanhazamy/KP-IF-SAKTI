<div
    id="modalHapus"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4"
>

    <div class="bg-white w-full max-w-[400px] rounded-2xl p-6 relative shadow-2xl border border-gray-100 transform scale-95 transition-all duration-300">

        <h2 class="text-[16px] font-bold text-gray-900 leading-tight mb-3">
            Hapus Anggota
        </h2>

        <p
            id="hapusText"
            class="text-[13px] text-gray-500 font-medium leading-relaxed mb-6"
        ></p>

        <div class="flex justify-end gap-3 border-t border-gray-50 pt-4">

            <button
                onclick="closeDeleteModal()"
                class="px-4 py-2 border border-gray-200 hover:bg-gray-50 transition text-gray-600 rounded-xl font-semibold text-[13px] cursor-pointer"
            >
                Batal
            </button>

            <form
                id="formDeleteAnggota"
                method="POST"
                class="m-0"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 transition text-white px-4 py-2 rounded-xl font-bold text-[13px] shadow-sm hover:shadow cursor-pointer"
                >
                    Hapus
                </button>

            </form>

        </div>

    </div>

</div>