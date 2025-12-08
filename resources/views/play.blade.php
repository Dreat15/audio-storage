<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Audio Player</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- NAVBAR -->
  <nav class="bg-white shadow mb-8">
    <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
      <a href="/" class="text-lg font-semibold">Meine Audios</a>

      <div class="flex space-x-4">
        <a href="/upload" class="hover:underline">Upload</a>
        <a href="/" class="hover:underline">Home</a>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow text-center">
    <h1 class="text-xl font-bold mb-4">{{ $audio->description }}</h1>

    <audio controls class="w-full mt-4">
      <source src="{{ $path }}" type="audio/mpeg">
      Dein Browser unterstützt kein HTML5 Audio.
    </audio>
  </div>

</body>
</html>

