@extends('layouts.app')

@section('title', 'Audio Abspielen')

@section('content')
<div class="bg-white p-6 rounded-lg shadow text-center">

    <h1 class="text-2xl font-bold mb-4">{{ $audio->description }}</h1>

    <audio controls class="w-full mt-4">
        <source src="{{ $path }}" type="audio/mpeg">
        Dein Browser unterstützt das Abspielen nicht.
    </audio>

</div>
@endsection
