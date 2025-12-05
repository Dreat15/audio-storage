<h1 class="text-2xl font-bold mb-4">Alle Audio Dateien</h1>

@foreach ($audios as $audio)
    <div class="p-4 border mb-4 rounded-lg">
        <h2 class="font-bold text-lg">{{ $audio->description }}</h2>

        <img class="my-2"
             src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(150)->generate(route('audio.play', $audio->id))) }}"
             alt="QR Code">

        <a href="{{ route('audio.play', $audio->id) }}" 
           class="text-blue-500 underline">Abspielen</a>
    </div>
@endforeach
