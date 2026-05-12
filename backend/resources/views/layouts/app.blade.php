<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fatayat NU Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F5F5F5] font-[Poppins]">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        @include('partials.sidebar')

        <!-- MAIN -->
        <div class="flex-1 flex flex-col">

            <!-- HEADER -->
            @include('partials.header')

            <!-- CONTENT -->
            <main class="p-8">

                @yield('content')

            </main>

        </div>

    </div>

</body>
</html>