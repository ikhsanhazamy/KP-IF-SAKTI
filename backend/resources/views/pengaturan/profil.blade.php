<form
    method="POST"
    action="{{ route('pengaturan.profil.update') }}"
    enctype="multipart/form-data"
    class="m-0"
>
    @csrf

    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

        <h2 class="text-[16px] font-bold text-gray-900 mb-6 pb-2 border-b border-gray-50">
            Informasi Profil
        </h2>

        <!-- FOTO -->
        <div class="flex items-center gap-6 mb-8 bg-gray-50/50 p-4 rounded-xl border border-gray-50">

            <div class="w-16 h-16 rounded-full overflow-hidden bg-[#EDF7F0] flex-shrink-0 shadow-sm border-2 border-white">
                @if(auth()->user()->photo)
                    <img
                        src="{{ asset('storage/' . auth()->user()->photo) }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-xl font-bold text-[#0F5E3A]">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <label
                    for="photo"
                    class="cursor-pointer px-4 py-2 border border-gray-200 rounded-xl text-xs font-semibold hover:bg-gray-50 transition bg-white text-gray-700 shadow-sm select-none"
                >
                    Ganti Foto
                </label>
                <input
                    type="file"
                    name="photo"
                    id="photo"
                    class="hidden"
                >
                @if(auth()->user()->photo)
                    <button
                        type="submit"
                        formaction="{{ route('pengaturan.profil.foto.delete') }}"
                        formmethod="POST"
                        class="text-red-600 hover:text-red-700 text-xs font-bold transition cursor-pointer select-none"
                    >
                        Hapus Foto
                    </button>
                @endif
            </div>

        </div>

        <!-- FORM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ auth()->user()->name }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                >
            </div>

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                >
            </div>

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    No Telepon
                </label>
                <input
                    type="text"
                    name="phone"
                    value="{{ auth()->user()->phone }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                >
            </div>

            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Jabatan
                </label>
                <input
                    type="text"
                    name="jabatan"
                    value="{{ auth()->user()->jabatan }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                >
            </div>

        </div>

        <div class="flex justify-end mt-6 pt-5 border-t border-gray-50">
            <button
                type="submit"
                class="px-5 py-2.5 bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition text-white rounded-xl font-bold text-[13px] cursor-pointer"
            >
                Simpan Perubahan
            </button>
        </div>

    </div>

</form>