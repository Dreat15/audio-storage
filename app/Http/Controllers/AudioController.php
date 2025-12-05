<?php

namespace App\Http\Controllers;

use App\Models\Audios;
use Illuminate\Http\Request;
use Illuminate\Routes\UrlGenerator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Filters\Audio;

//use FFMpeg\FFMpeg;
//use FFMpeg\Format\Audio\Wav;

//require 'vendor/autoload.php';

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

        //$file = $request->file('audio');
        $filename = Str::random(16) . '.mp3';

        $targetName = pathinfo($filename, PATHINFO_FILENAME) . '.wav';
        $targetPath = 'public/storage/audio' . $targetName;

        //$file->storeAs('audio', $filename, 'public');

       /* $f = FFMpeg::fromDisk('public')
            ->open('audio/' . $filename)
            ->export()
            ->toDisk('public')
            ->inFormat((new \FFMpeg\Format\Audio\Wav))
            ->save($targetPath);*/
        FFMpeg::fromDisk('public')
            //->open('audio/' . $filename)
            ->open($request->file('audio'))
            ->export()
            ->toDisk('public')
            ->inFormat((new \FFMpeg\Format\Audio\Wav))
            ->addFilter([
        '-ar', '44100',
        '-ac', '2',
        '-acodec', 'pcm_s16le',
        '-map_metadata', '-1'
    ])
            ->save('audio/' . $targetName);
 

            /*
        $disk = Storage::disk('public');
        $ffmpeg = FFMpeg::create();
        $audio = $ffmpeg->open($disk->path('audio/' . $filename));

        $format = new Wav();
        $format->setAudioChannels(2)
                ->setAudioKiloBitrate(1411);

        $audio->save($format, $disk->path('audio/' . $filename));*/

        // Datei speichern
        

        // DB speichern
        $audio = Audios::create([
            'filename' => $targetName,
            'description' => $request->description,
        ]);

        $ip = $_SERVER['APP_URL'];

        $link = $ip . route('audio.play', $audio->id, false);

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
