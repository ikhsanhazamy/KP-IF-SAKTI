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
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        body {
            font-family: 'Poppins', sans-serif;
        }

    </style>

</head>

<body class="min-h-screen flex bg-gray-100">

    <!-- LEFT -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-green-800 to-green-500 items-center justify-center p-20 relative overflow-hidden">

        <!-- BLUR -->
        <div class="absolute w-[500px] h-[500px] bg-green-300/20 rounded-full blur-3xl bottom-[-150px] left-[-100px]"></div>

        <div class="relative z-10">

            <h1 class="text-white text-7xl font-bold leading-tight">

                Memberdayakan
                <br>

                <span class="text-green-200">
                    Perempuan
                </span>

                Melalui
                <br>

                Organisasi Digital

            </h1>

            <p class="text-green-100 text-xl mt-8 max-w-xl leading-relaxed">

                Sistem informasi administrasi Fatayat NU Kabupaten Sukabumi
                untuk pengelolaan anggota, PAC, kegiatan, dan laporan organisasi.

            </p>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">

        <div class="w-full max-w-md bg-white rounded-[32px] shadow-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="bg-gradient-to-r from-green-800 to-green-600 text-white text-center py-10 px-6">

                <h2 class="text-4xl font-bold">
                    Dashboard Admin
                </h2>

                <p class="mt-3 text-green-100">
                    Fatayat NU Kabupaten Sukabumi
                </p>

            </div>

            <!-- CONTENT -->
            <div class="p-10">

                <h3 class="text-4xl font-bold text-center text-gray-800">
                    Selamat Datang
                </h3>

                <p class="text-center text-gray-500 mt-3 mb-10 leading-relaxed">
                    Silakan login untuk mengakses dashboard administrasi
                </p>

                <!-- ERROR -->
                @if ($errors->any())

                    <div class="bg-red-100 border border-red-200 text-red-600 rounded-2xl px-5 py-4 mb-6 text-sm">

                        {{ $errors->first() }}

                    </div>

                @endif

                <!-- FORM -->
                <form action="/login" method="POST">

                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-6">

                        <label class="block text-sm font-semibold mb-3 text-gray-700">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@fatayatnusukabumi.or.id"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-green-200 transition"
                            required
                        >

                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-6">

                        <label class="block text-sm font-semibold mb-3 text-gray-700">

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-green-200 transition"
                            required
                        >

                    </div>

                    <!-- OPTIONS -->
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-8">

                        <label class="flex items-center gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                class="rounded border-gray-300"
                            >

                            Ingat saya

                        </label>

                        <a
                            href="#"
                            class="text-green-700 hover:underline"
                        >
                            Lupa password?
                        </a>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-green-800 hover:bg-green-900 transition text-white py-4 rounded-2xl font-semibold text-lg shadow-lg"
                    >

                        Login

                    </button>

                </form>

                <!-- FOOTER -->
                <p class="text-center text-gray-500 mt-8 leading-relaxed">

                    Belum punya akun?

                    <a
                        href="#"
                        class="text-green-700 font-semibold hover:underline"
                    >
                        Hubungi Admin
                    </a>

                </p>

                <div class="border-t mt-8 pt-6 text-center">

                    <a
                        href="#"
                        class="text-gray-500 hover:text-green-700 transition"
                    >

                        ← Kembali ke Beranda

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>
</html>