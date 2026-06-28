<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

    <h2 class="text-[16px] font-bold text-gray-900 mb-6 pb-2 border-b border-gray-50">
        Keamanan & Password
    </h2>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-100 text-[#0F5E3A] px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl text-xs font-semibold">
            {{ session('error') }}
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('pengaturan.password.update') }}"
        class="m-0"
    >
        @csrf

        <div class="space-y-4">

            <!-- Password Lama -->
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Password Lama
                </label>
                <input
                    type="password"
                    name="old_password"
                    placeholder="Masukkan password lama"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                    required
                >
                @error('old_password')
                    <p class="text-red-600 text-xs mt-1 font-medium">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Baru -->
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Password Baru
                </label>
                <input
                    type="password"
                    name="new_password"
                    placeholder="Minimal 8 karakter"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                    required
                >
                @error('new_password')
                    <p class="text-red-600 text-xs mt-1 font-medium">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">
                    Konfirmasi Password Baru
                </label>
                <input
                    type="password"
                    name="new_password_confirmation"
                    placeholder="Ulangi password baru"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-[13px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                    required
                >
            </div>

        </div>

        <!-- Two Factor Authentication -->
        <div class="border-t border-gray-50 mt-6 pt-6">

            <h3 class="text-[14px] font-bold text-gray-800 mb-4">
                Two-Factor Authentication
            </h3>

            <div class="border border-gray-100 rounded-2xl p-4 flex items-center justify-between bg-gray-50/50">

                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-lg">
                        🔒
                    </div>
                    <div>
                        <h4 class="text-[13px] font-bold text-gray-800">
                            2FA via SMS
                        </h4>
                        <p class="text-xs text-gray-400 font-medium">
                            Aktifkan verifikasi tambahan melalui SMS
                        </p>
                    </div>
                </div>

                <label class="relative inline-flex items-center cursor-pointer select-none">
                    <input
                        type="checkbox"
                        name="two_factor"
                        class="sr-only peer"
                    >
                    <div
                        class="w-11 h-6 bg-gray-200 rounded-full peer
                        peer-checked:bg-[#0F5E3A]
                        after:content-['']
                        after:absolute
                        after:top-[2px]
                        after:left-[2px]
                        after:bg-white
                        after:rounded-full
                        after:h-5
                        after:w-5
                        after:transition-all
                        peer-checked:after:translate-x-full">
                    </div>
                </label>

            </div>

        </div>

        <!-- Tombol -->
        <div class="flex justify-end mt-6 pt-5 border-t border-gray-50">
            <button
                type="submit"
                class="px-5 py-2.5 bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition text-white rounded-xl font-bold text-[13px] cursor-pointer"
            >
                Update Password
            </button>
        </div>

    </form>

</div>