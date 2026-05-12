<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex">

    <!-- LEFT -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-green-700 to-green-400 items-center justify-center p-20 relative overflow-hidden">

        <div class="absolute w-[500px] h-[500px] bg-green-300 opacity-20 rounded-full blur-3xl bottom-[-150px] left-[-100px]"></div>

        <div class="relative z-10">
            <h1 class="text-white text-7xl font-bold leading-tight">
                Memberdayakan
                <br>
                <span class="text-green-300">
                    Perempuan
                </span>
                Melalui Organisasi
                <br>
                 Digital
            </h1>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="w-full lg:w-1/2 bg-gray-100 flex items-center justify-center p-6">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="bg-gradient-to-r from-green-800 to-green-500 text-white text-center py-10 px-6">
                <h2 class="text-4xl font-bold">
                    Dashboard Admin
                </h2>

                <p class="mt-2 text-green-100">
                    Fatayat NU Kabupaten Sukabumi
                </p>
            </div>

            <!-- CONTENT -->
            <div class="p-10">

                <h3 class="text-4xl font-bold text-center text-gray-800">
                    Selamat Datang
                </h3>

                <p class="text-center text-gray-500 mt-3 mb-10">
                    Silakan login untuk mengakses dashboard
                </p>

                <form>

                    <!-- EMAIL -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            placeholder="admin@fatayatnusukabumi.or.id"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-green-500"
                        >
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            placeholder="••••••••"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-green-500"
                        >
                    </div>

                    <!-- OPTIONS -->
                    <div class="flex justify-between text-sm text-gray-500 mb-8">
                        <label class="flex items-center gap-2">
                            <input type="checkbox">
                            Ingat saya
                        </label>

                        <a href="#" class="text-green-700 hover:underline">
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

                <p class="text-center text-gray-500 mt-8">
                    Belum punya akun?
                    <a href="#" class="text-green-700 font-semibold">
                        Hubungi Admin
                    </a>
                </p>

                <div class="border-t mt-8 pt-6 text-center">
                    <a href="#" class="text-gray-500 hover:text-green-700">
                        ← Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>