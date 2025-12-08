@extends('layouts.app')

@section('title', 'Audio Hochladen')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-4">Audio hochladen</h1>

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="block mb-2 font-semibold">Audio Datei:</label>
        <input type="file" name="audio" class="border p-2 mb-4 w-full rounded">

        <label class="block mb-2 font-semibold">Beschreibung:</label>
        <textarea name="description"
                  class="border p-2 w-full mb-4 rounded"
        ></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg w-full mt-2">
            Upload
        </button>
    </form>

</div>
@endsection
