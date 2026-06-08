<form
    method="POST"
    action="{{ route('pengaturan.profil.update') }}"
    enctype="multipart/form-data"
>
    @csrf

    <div class="bg-white rounded-2xl border border-gray-200 p-6">

        <h2 class="text-[20px] font-bold mb-6">
            Informasi Profil
        </h2>

        <!-- FOTO -->
        <div class="flex items-center gap-6 mb-10">

            <div
                class="w-24 h-24 rounded-full overflow-hidden bg-[#EDF7F0]"
            >

                @if(auth()->user()->photo)

                    <img
                        src="{{ asset('storage/' . auth()->user()->photo) }}"
                        class="w-full h-full object-cover"
                    >

                @else

                    <div
                        class="w-full h-full flex items-center justify-center"
                    >
                        <span class="text-3xl font-bold text-[#15633D]">
                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                        </span>
                    </div>

                @endif

            </div>

            <div class="flex gap-3">

                <label
                    for="photo"
                    class="cursor-pointer px-5 py-3 border rounded-xl hover:bg-gray-50"
                >
                    Ganti Foto
                </label>

                <input
                    type="file"
                    name="photo"
                    id="photo"
                    class="hidden"
                >

            </div>

        </div>

        <!-- FORM -->
        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="block text-sm font-medium mb-2">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ auth()->user()->name }}"
                    class="w-full border rounded-xl px-4 py-3"
                >

            </div>

            <div>

                <label class="block text-sm font-medium mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full border rounded-xl px-4 py-3"
                >

            </div>

            <div>

                <label class="block text-sm font-medium mb-2">
                    No Telepon
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ auth()->user()->phone }}"
                    class="w-full border rounded-xl px-4 py-3"
                >

            </div>

            <div>

                <label class="block text-sm font-medium mb-2">
                    Jabatan
                </label>

                <input
                    type="text"
                    name="jabatan"
                    value="{{ auth()->user()->jabatan }}"
                    class="w-full border rounded-xl px-4 py-3"
                >

            </div>

        </div>

        <div class="flex justify-between mt-8">

            <button
                type="submit"
                formaction="{{ route('pengaturan.profil.foto.delete') }}"
                formmethod="POST"
                class="text-red-500"
            >
                Hapus Foto
            </button>

            <button
                type="submit"
                class="bg-[#15633D] text-white px-6 py-3 rounded-xl"
            >
                Simpan Perubahan
            </button>

        </div>

    </div>

</form>