@extends('layouts.app')

@section('title', 'QR-Code')

@section('content')
<style>
    @media print {
        nav, footer, .no-print { display: none !important; }
        body { background: white; margin: 0; padding: 0; }
        .bg-white { background: white !important; box-shadow: none !important; border: none !important; }
        .print-container { margin: 0; padding: 0; }
        .print-container img { max-width: 100%; }
    }
</style>
<div class="bg-white p-6 rounded-lg shadow text-center">

    <h1 class="text-2xl font-bold mb-4">QR-Code für deine Datei</h1>

    <button onclick="window.print()" class="no-print mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        🖨️ Drucken
    </button>

    <div class="print-container">
        <h2 class="text-lg font-semibold mb-2">{{ $audio->description }}</h2>
        <img src="data:image/png;base64,{{ $qr }}" class="mx-auto mb-4 rounded" alt="QR Code">
        <p class="text-sm text-gray-600">Datei: {{ $audio->filename }}</p>
    </div>

    <a href="{{ $link }}" class="text-blue-600 underline font-semibold block mt-4 no-print">
        ▶️ Audio direkt öffnen
    </a>

</div>
@endsection
