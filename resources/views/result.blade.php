<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- NAVBAR -->
  <nav class="bg-white shadow mb-8">
    <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
      <a href="/" class="text-lg font-semibold">Meine Audios</a>

      <div class="flex space-x-4">
        <a href="/upload" class="hover:underline">Upload</a>
        <a href="/" class="hover:underline">Übersicht</a>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow text-center">

    <h1 class="text-2xl font-bold mb-4">QR-Code für deine Datei</h1>

    <img
      src="data:image/png;base64,{{ $qr }}"
      alt="QR Code"
      class="mx-auto mb-4 rounded"
    >

    <p class="mb-4">
      <a href="{{ $link }}"
         class="text-blue-600 font-semibold underline hover:text-blue-800">
         ▶️ Audio direkt öffnen
      </a>
    </p>

    <p class="text-sm text-gray-600">
      Datei: <span class="font-mono">{{ $audio->filename }}</span>
    </p>

  </div>

</body>
</html>
