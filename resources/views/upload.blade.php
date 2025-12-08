<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Audio Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-3xl mx-auto flex items-center justify-between p-4">

            <!-- Logo / Titel -->
            <a href="/" class="text-xl font-bold text-gray-700">
                AudioStorage
            </a>

            <!-- Mobile Menu Toggle -->
            <input type="checkbox" id="menu-toggle" class="hidden peer">
            <label for="menu-toggle" class="block cursor-pointer lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>

            <!-- Navigation Links -->
            <div class="hidden peer-checked:block absolute left-0 top-full w-full bg-white shadow lg:shadow-none lg:static lg:block">
                <ul class="flex flex-col lg:flex-row lg:items-center">
                    <li>
                        <a href="/upload" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Upload</a>
                    </li>
                    <li>
                        <a href="/list" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Übersicht</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- CONTENT -->
    <div class="max-w-xl mx-auto bg-white p-6 mt-6 rounded-lg shadow">

        <h1 class="text-2xl font-bold mb-4 text-gray-800">Audio hochladen</h1>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="text-sm">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Audio Datei:</label>
                <input type="file" name="audio" class="border rounded p-2 w-full bg-gray-50" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Beschreibung:</label>
                <textarea name="description" class="border rounded p-2 w-full bg-gray-50 h-24 resize-none" required></textarea>
            </div>

            <button class="w-full bg-blue-600 text-white py-2 rounded font-medium hover:bg-blue-700 transition">
                Upload
            </button>
        </form>

    </div>

</body>
</html>
