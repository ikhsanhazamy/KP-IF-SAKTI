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
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">

        <div
            class="w-full max-w-[491px] bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden"
        >

            <!-- HEADER -->
            <div
                class="bg-gradient-to-r from-[#0F5E3A] to-[#4FA36C] text-white text-center py-8 px-6"
            >

                <h2
                    class="text-[24px] font-bold leading-[32px]"
                >
                    Dashboard Admin
                </h2>

                <p
                    class="mt-2 text-[16px] text-white/90"
                >
                    Fatayat NU Kabupaten Sukabumi
                </p>

            </div>

            <!-- CONTENT -->
            <div class="p-8">

                <h3
                    class="text-[24px] font-bold text-center text-[#1D1D1D] leading-[32px]"
                >
                    Selamat Datang
                </h3>

                <p
                    class="text-center text-[#4A5565] text-[16px] mt-3 mb-10"
                >
                    Silakan login untuk mengakses dashboard administrasi
                </p>

                <!-- ERROR -->
                @if ($errors->any())

                    <div
                        class="bg-red-100 border border-red-200 text-red-600 rounded-xl px-4 py-3 mb-6 text-sm"
                    >

                        {{ $errors->first() }}

                    </div>

                @endif

                <!-- FORM -->
                <form action="/login" method="POST">

                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-6">

                        <label
                            class="block text-[14px] font-medium mb-2 text-[#1D1D1D]"
                        >

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@fatayatnusukabumi.or.id"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 text-[16px] focus:outline-none focus:ring-4 focus:ring-green-200 transition"
                            required
                        >

                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-6">

                        <label
                            class="block text-[14px] font-medium mb-2 text-[#1D1D1D]"
                        >

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 text-[16px] focus:outline-none focus:ring-4 focus:ring-green-200 transition"
                            required
                        >

                    </div>

                    <!-- OPTIONS -->
                    <div
                        class="flex items-center justify-between text-[14px] text-[#4A5565] mb-8"
                    >

                        <label
                            class="flex items-center gap-3 cursor-pointer"
                        >

                            <input
                                type="checkbox"
                                class="rounded border-gray-300"
                            >

                            Ingat saya

                        </label>

                        <a
                            href="#"
                            class="text-[#0F5E3A] text-[14px] hover:underline"
                        >

                            Lupa password?

                        </a>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-[#0F5E3A] hover:bg-[#0c4f31] transition text-white py-4 rounded-xl font-medium text-[16px] shadow-lg"
                    >

                        Login

                    </button>

                </form>

                <!-- FOOTER -->
                <p
                    class="text-center text-[#4A5565] text-[16px] mt-8"
                >

                    Belum punya akun?

                    <a
                        href="#"
                        class="text-[#0F5E3A] text-[16px] font-medium hover:underline"
                    >

                        Hubungi Admin

                    </a>

                </p>

                <!-- BACK -->
                <div
                    class="border-t border-gray-100 mt-8 pt-6 text-center"
                >

                    <a
                        href="#"
                        class="text-[#4A5565] text-[14px] hover:text-[#0F5E3A] transition"
                    >

                        ← Kembali ke Beranda

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>
</html>