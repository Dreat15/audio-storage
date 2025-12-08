<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alle Audio Dateien</title>
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
  <div class="max-w-3xl mx-auto px-4">

    <h1 class="text-2xl font-bold mb-6 text-center">Alle Audio Dateien</h1>

    @foreach ($audios as $audio)
      <div class="bg-white p-4 border rounded-lg shadow mb-6">

        <h2 class="font-bold text-lg mb-2">{{ $audio->description }}</h2>

        <div class="flex justify-center my-4">
          <img
            src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(150)->generate(route('audio.play', $audio->id))) }}"
            alt="QR Code"
            class="rounded"
          >
        </div>

        <div class="text-center">
          <a href="{{ route('audio.play', $audio->id) }}"
             class="text-blue-600 font-semibold underline hover:text-blue-800">
             ▶️ Abspielen
          </a>
        </div>
      </div>
    @endforeach

  </div>

</body>
</html>
