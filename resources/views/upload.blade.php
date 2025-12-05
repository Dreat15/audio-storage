<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Audio Upload</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Audio hochladen</h1>

    @if($errors->any())
      <div class="mb-4 text-red-600">
        <ul>
          @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

<form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label class="block mb-2 font-bold">Audio Datei:</label>
    <input type="file" name="audio" class="border p-2 mb-4" required>

    <label class="block mb-2 font-bold">Beschreibung:</label>
    <textarea name="description" class="border p-2 w-full mb-4" required></textarea>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
</form>

  </div>
</body>
</html>
