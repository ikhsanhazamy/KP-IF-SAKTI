<div class="space-y-6">
    @if(session('success'))
        <div class="rounded-xl bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-gray-200 bg-white p-6">
        <h2 class="mb-6 text-[20px] font-bold text-[#1D1D1D]">
            Keamanan & Password
        </h2>

        <form method="POST" action="{{ route('pengaturan.password.update') }}">
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="mb-2 block text-sm font-medium" for="old_password">
                        Password Lama
                    </label>
                    <input
                        type="password"
                        name="old_password"
                        id="old_password"
                        placeholder="Masukkan password lama"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                        required
                    >
                    @error('old_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium" for="new_password">
                        Password Baru
                    </label>
                    <input
                        type="password"
                        name="new_password"
                        id="new_password"
                        placeholder="Minimal 8 karakter"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                        required
                    >
                    @error('new_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium" for="new_password_confirmation">
                        Konfirmasi Password Baru
                    </label>
                    <input
                        type="password"
                        name="new_password_confirmation"
                        id="new_password_confirmation"
                        placeholder="Ulangi password baru"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#15633D]"
                        required
                    >
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button
                    type="submit"
                    class="h-10 rounded-xl bg-[#15633D] px-6 font-medium text-white transition hover:bg-[#0F5E3A]"
                >
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-6">
        <h3 class="text-[18px] font-bold">Two-Factor Authentication</h3>
        <p class="mt-1 text-sm text-gray-500">
            Simpan preferensi verifikasi tambahan untuk akun ini.
        </p>

        <form
            method="POST"
            action="{{ route('pengaturan.two-factor.update') }}"
            class="mt-5"
        >
            @csrf

            <div class="flex items-center justify-between gap-6 rounded-2xl border border-gray-200 p-5">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-[#15633D]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="10" width="14" height="10" rx="2"></rect>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v2"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold">2FA via SMS</h4>
                        <p class="text-sm text-gray-500">
                            Preferensi akan disimpan pada profil pengguna.
                        </p>
                    </div>
                </div>

                <label class="relative inline-flex shrink-0 cursor-pointer items-center">
                    <input type="hidden" name="two_factor_enabled" value="0">
                    <input
                        type="checkbox"
                        name="two_factor_enabled"
                        value="1"
                        class="peer sr-only"
                        @checked(auth()->user()->two_factor_enabled)
                    >
                    <span class="h-6 w-11 rounded-full bg-gray-200 transition peer-checked:bg-[#15633D]"></span>
                    <span class="absolute left-[2px] top-[2px] h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-full"></span>
                </label>
            </div>

            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    class="h-10 rounded-xl border border-[#15633D] px-6 font-medium text-[#15633D] transition hover:bg-green-50"
                >
                    Simpan Pengaturan 2FA
                </button>
            </div>
        </form>
    </div>
</div>
