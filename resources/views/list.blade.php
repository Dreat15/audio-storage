@extends('layouts.app')

@section('title', 'Alle Audio Dateien')

@section('content')
<style>
    @media print {
        nav, footer, .no-print { display: none !important; }
        body { background: white; margin: 0; padding: 0; }
        .audio-item { page-break-inside: avoid; margin: 0 0 1cm 0; padding: 1cm; border: 1px solid #ccc; background: white !important; }
        .audio-item img { max-width: 100%; }
        .audio-item h2 { display: block !important; }
    }
</style>
<h1 class="text-2xl font-bold mb-4">Alle Audio Dateien</h1>

@foreach ($audios as $audio)
    <div class="relative p-4 border mb-4 rounded-lg bg-white shadow audio-item" style="position: relative;">

        <h2 class="font-bold text-lg">{{ $audio->description }}</h2>

        <img class="my-4 mx-auto"
             src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(150)->style('round')->eye('circle')->generate(route('audio.play', $audio->id))) }}"
             alt="QR Code">

        <button onclick="window.print()" class="no-print mb-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600" style="font-size:12px;">
            🖨️ Drucken
        </button>

        <a href="{{ route('audio.play', $audio->id) }}"
           class="text-blue-600 underline block text-center no-print">
            Abspielen
        </a>
        <form action="{{ route('audio.destroy', $audio->id) }}" method="POST" onsubmit="return confirm('Delete this audio?')" class="absolute right-2 top-2" style="position: absolute; right: 1rem; top: 1rem;">
            @csrf
            @method('DELETE')
            <button type="submit" aria-label="Delete audio" class="flex items-center justify-center rounded-full" style="width:10px; height:10px; font-size:40px; line-height:1; z-index:50;">&times;</button>
        </form>
    </div>
@endforeach

<div class="mt-6">
    {{ $audios->links() }}
</div>
@endsection
