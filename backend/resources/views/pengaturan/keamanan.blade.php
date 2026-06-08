<div class="bg-white rounded-2xl border border-gray-200 p-6">

    <h2 class="text-[20px] font-bold text-[#1D1D1D] mb-6">
        Keamanan & Password
    </h2>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('pengaturan.password.update') }}"
    >
        @csrf

        <div class="space-y-5">

            <!-- Password Lama -->
            <div>

                <label class="block text-sm font-medium mb-2">
                    Password Lama
                </label>

                <input
                    type="password"
                    name="old_password"
                    placeholder="Masukkan password lama"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                    required
                >

                @error('old_password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- Password Baru -->
            <div>

                <label class="block text-sm font-medium mb-2">
                    Password Baru
                </label>

                <input
                    type="password"
                    name="new_password"
                    placeholder="Minimal 8 karakter"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                    required
                >

                @error('new_password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- Konfirmasi Password -->
            <div>

                <label class="block text-sm font-medium mb-2">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    name="new_password_confirmation"
                    placeholder="Ulangi password baru"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                    required
                >

            </div>

        </div>

        <!-- Two Factor Authentication -->
        <div class="border-t border-gray-200 mt-8 pt-8">

            <h3 class="text-[18px] font-bold mb-4">
                Two-Factor Authentication
            </h3>

            <div class="border border-gray-200 rounded-2xl p-5 flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-xl">
                        🔒
                    </div>

                    <div>

                        <h4 class="font-semibold">
                            2FA via SMS
                        </h4>

                        <p class="text-sm text-gray-500">
                            Aktifkan verifikasi tambahan melalui SMS
                        </p>

                    </div>

                </div>

                <label class="relative inline-flex items-center cursor-pointer">

                    <input
                        type="checkbox"
                        name="two_factor"
                        class="sr-only peer"
                    >

                    <div
                        class="w-11 h-6 bg-gray-200 rounded-full peer
                        peer-checked:bg-[#15633D]
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
        <div class="flex justify-end mt-8">

            <button
                type="submit"
                class="bg-[#15633D] text-white px-6 h-10 rounded-xl font-medium hover:bg-[#0F5E3A] transition"
            >
                Update Password
            </button>

        </div>

    </form>

</div>