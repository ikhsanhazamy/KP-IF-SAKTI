<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Dashboard Admin
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

    </style>

</head>

<body class="min-h-screen flex bg-gray-100">

    <!-- LEFT -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-[#0F5E3A] to-[#4FA36C] items-center justify-center p-20 relative overflow-hidden">

        <!-- BLUR -->
        <div class="absolute w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl bottom-[-150px] left-[-100px]"></div>

        <div class="absolute w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl top-[-150px] right-[-100px]"></div>

        <div class="relative z-10 max-w-xl">

            <h1
                class="text-white text-[60px] font-bold leading-[75px]"
            >

                Memberdayakan

                <span class="text-[#00FF8B]">
                    Perempuan
                </span>

                Melalui
                <br>

                Organisasi Digital

            </h1>

            <p
                class="text-green-100 text-[18px] mt-8 leading-relaxed max-w-lg"
            >

                Sistem informasi administrasi Fatayat NU Kabupaten Sukabumi
                untuk pengelolaan anggota, PAC, kegiatan, dan laporan organisasi.

            </p>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#f6f8f7]">

        <div class="w-full max-w-[460px] bg-white rounded-2xl border border-gray-100/80 shadow-md overflow-hidden"
        >
            <!-- HEADER -->
            <div class="text-center pt-10 pb-6 px-8 border-b border-gray-50 bg-gradient-to-b from-gray-50/50 to-white">
                <div class="w-14 h-14 rounded-full bg-[#0F5E3A] flex items-center justify-center font-bold text-white text-[18px] tracking-wider mx-auto shadow-sm">
                    FN
                </div>
                <h2 class="text-[20px] font-bold text-gray-900 mt-4 leading-tight">
                    Dashboard Admin
                </h2>
                <p class="mt-1 text-[12px] text-gray-400 font-medium">
                    Pimpinan Cabang Fatayat NU Kabupaten Sukabumi
                </p>
            </div>

            <!-- CONTENT -->
            <div class="p-8 pt-6">
                <!-- ERROR -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-600 rounded-xl px-4 py-3 mb-6 text-[13px] font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- FORM -->
                <form action="/login" method="POST">
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-5">
                        <label class="block text-[13px] font-semibold mb-2 text-gray-700">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@fatayatnu.or.id"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-[14px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-5">
                        <label class="block text-[13px] font-semibold mb-2 text-gray-700">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-[14px] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 focus:border-[#0F5E3A] transition duration-150"
                            required
                        >
                    </div>

                    <!-- OPTIONS -->
                    <div class="flex items-center justify-between text-[13px] text-gray-500 mb-6">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-gray-300 text-[#0F5E3A] focus:ring-[#0F5E3A]/20 cursor-pointer"
                            >
                            Ingat saya
                        </label>
                        <a href="#" class="text-[#0F5E3A] font-semibold hover:underline">
                            Lupa password?
                        </a>
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-[#0F5E3A] hover:bg-[#0b4e30] hover:shadow-md transition duration-200 text-white py-3.5 rounded-xl font-bold text-[14px] shadow-sm cursor-pointer"
                    >
                        Login
                    </button>
                </form>

                <!-- FOOTER -->
                <p class="text-center text-gray-500 text-[13px] mt-6">
                    Belum punya akun?
                    <a href="#" class="text-[#0F5E3A] font-bold hover:underline">
                        Hubungi Admin
                    </a>
                </p>

                <!-- BACK -->
                <div class="border-t border-gray-100 mt-6 pt-5 text-center">
                    <a href="{{ config('app.frontend_url', env('FRONTEND_URL', 'http://localhost:5173')) }}" class="text-gray-400 hover:text-[#0F5E3A] text-[12px] font-medium transition flex items-center justify-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>
</html>