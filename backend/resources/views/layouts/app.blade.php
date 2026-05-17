<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fatayat NU Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#F5F5F5] font-[Poppins] overflow-hidden">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside class="w-[260px] shrink-0 bg-white border-r h-screen">

            @include('partials.sidebar')

        </aside>

        <!-- RIGHT AREA -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <!-- HEADER -->
            <div class="shrink-0">

                @include('partials.header')

            </div>

            <!-- CONTENT -->
            <main class="flex-1 overflow-y-auto p-8">

                @yield('content')

            </main>

        </div>

    </div>

</body>
</html>