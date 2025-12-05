<?php

namespace App\Http\Controllers;

use App\Models\Audios;
use Illuminate\Http\Request;
use Illuminate\Routes\UrlGenerator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AudioController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
        'audio' => 'required|mimes:mp3,wav,ogg,m4a|max:204800',
        'description' => 'required|string|max:500'
        ]);

        $file = $request->file('audio');
        $filename = Str::random(16) . '.' . $file->getClientOriginalExtension();

        // Datei speichern
        $file->storeAs('audio', $filename, 'public');

        // DB speichern
        $audio = Audios::create([
            'filename' => $filename,
            'description' => $request->description,
        ]);

        $ip = $_SERVER['SERVER_ADDR'];

        $link = "http://{$ip}" . route('audio.play', $audio->id, false);

        $qr = base64_encode(QrCode::format('png')->size(300)->generate($link));


        //$link = route('audio.play', $audio->id);
        //$qr = base64_encode(QrCode::format('png')->size(300)->generate($link));

        return view('result', compact('audio', 'qr', 'link'));
    }


public function play($id)
{
    $audio = Audios::findOrFail($id);

    $path = asset('storage/audio/' . $audio->filename);

    return view('play', compact('audio', 'path'));
}

public function list()
{
    $audios = Audios::latest()->get();

    return view('list', compact('audios'));
}


}
