<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi 2FA - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .code-input {
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.5em;
            text-align: center;
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-100">

    <!-- LEFT -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-[#0F5E3A] to-[#4FA36C] items-center justify-center p-20 relative overflow-hidden">
        <div class="absolute w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl bottom-[-150px] left-[-100px]"></div>
        <div class="absolute w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl top-[-150px] right-[-100px]"></div>

        <div class="relative z-10 max-w-xl">
            <h1 class="text-white text-[60px] font-bold leading-[75px]">
                Keamanan <span class="text-[#00FF8B]">Tingkat Lanjut</span>
            </h1>
            <p class="text-green-100 text-[18px] mt-8 leading-relaxed max-w-lg">
                Autentikasi dua faktor aktif untuk melindungi akun administrator dan data organisasi Fatayat NU Kabupaten Sukabumi.
            </p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#f6f8f7]">
        <div class="w-full max-w-[460px] bg-white rounded-2xl border border-gray-100/80 shadow-md overflow-hidden">
            <!-- HEADER -->
            <div class="text-center pt-10 pb-6 px-8 border-b border-gray-50 bg-gradient-to-b from-gray-50/50 to-white">
                <div class="w-14 h-14 rounded-full bg-emerald-100 text-[#0F5E3A] flex items-center justify-center font-bold text-[18px] tracking-wider mx-auto shadow-sm">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h2 class="text-[20px] font-bold text-gray-900 mt-4 leading-tight">
                    Verifikasi Dua Faktor
                </h2>
                <p class="mt-1 text-[13px] text-gray-500 font-medium">
                    Masukkan 6 digit kode OTP yang telah dibuat untuk akun Anda.
                </p>
            </div>

            <!-- CONTENT -->
            <div class="p-8 pt-6">
                <!-- STATUS MESSAGE -->
                @if (session('status'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 mb-6 text-[13px] font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- ERROR MESSAGE -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-600 rounded-xl px-4 py-3 mb-6 text-[13px] font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- FORM -->
                <form action="{{ route('two-factor.verify') }}" method="POST">
                    @csrf

                    <!-- OTP CODE INPUT -->
                    <div class="mb-6">
                        <label class="block text-[13px] font-semibold mb-2 text-gray-700 text-center">
                            Kode OTP (6 Digit)
                        </label>
                        <input
                            type="text"
                            name="code"
                            inputmode="numeric"
                            pattern="[0-9]{6}"
                            maxlength="6"
                            placeholder="000000"
                            class="code-input w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[22px] font-bold text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                            autofocus
                            autocomplete="one-time-code"
                        >
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition duration-200 text-white py-3.5 rounded-xl font-bold text-[14px] shadow-sm cursor-pointer"
                    >
                        Verifikasi Kode
                    </button>
                </form>

                <!-- RESEND FORM -->
                <form action="{{ route('two-factor.resend') }}" method="POST" class="mt-4 text-center">
                    @csrf
                    <p class="text-gray-500 text-[13px]">
                        Tidak menerima kode?
                        <button type="submit" class="text-[#0F5E3A] font-bold hover:underline bg-transparent border-0 p-0 cursor-pointer text-[13px]">
                            Kirim Ulang Kode
                        </button>
                    </p>
                </form>

                <!-- BACK TO LOGIN -->
                <div class="border-t border-gray-100 mt-6 pt-5 text-center">
                    <a href="/login" class="text-gray-400 hover:text-[#0F5E3A] text-[12px] font-medium transition flex items-center justify-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Batal dan Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
