<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Audio Player</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8 text-center">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
<h1 class="text-xl font-bold mb-4">{{ $audio->description }}</h1>

<audio controls class="w-full mt-4">
    <source src="{{ $path }}" type="audio/mpeg">
</audio>

  </div>
</body>
</html>
