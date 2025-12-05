<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>QR Code</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-xl mx-auto bg-white p-6 rounded text-center shadow">
    <h1 class="text-xl font-bold mb-4">QR-Code für deine Datei</h1>

    <img src="data:image/png;base64,{{ $qr }}" alt="QR Code" class="mx-auto mb-4">

    <p class="mb-2"><a href="{{ $link }}" class="text-blue-600 underline">Audio direkt öffnen</a></p>
    <p class="text-sm text-gray-600">Datei: {{ $audio->filename }}</p>
  </div>
</body>
</html>
