<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Audio App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-lg font-semibold">Meine Audios</a>

            <div class="flex space-x-4">
                <a href="/list" class="hover:underline">Übersicht</a>
                <a href="/" class="hover:underline">Upload</a>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow max-w-3xl mx-auto w-full px-4">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-4 text-gray-500 text-sm">
        © {{ date('Y') }} Audio App
    </footer>

</body>
</html>
