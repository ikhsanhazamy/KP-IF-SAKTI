<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fatayat NU Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#F4F7F5] font-sans text-[#202321] overflow-hidden">

    <div class="flex h-screen">

        @include('partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col h-screen overflow-hidden">

            <div class="shrink-0">
                @include('partials.header')
            </div>

            <main class="min-w-0 flex-1 overflow-y-auto px-5 py-6 sm:px-7 lg:px-8 lg:py-7">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>
