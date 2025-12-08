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

        $filename = Str::random(16) . '.mp3';

        $targetName = pathinfo($filename, PATHINFO_FILENAME) . '.wav';
        $targetPath = 'public/storage/audio' . $targetName;

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
        

        // DB speichern
        $audio = Audios::create([
            'filename' => $targetName,
            'description' => $request->description,
        ]);

        $ip = $_SERVER['APP_URL'];
        $link = $ip . route('audio.play', $audio->id, false);
        $qr = base64_encode(QrCode::format('png')->size(300)->style('round')->eye('circle')->generate($link));

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
    $audios = Audios::latest()->paginate(10);

    return view('list', compact('audios'));
}

    public function destroy($id)
    {
        $audio = Audios::findOrFail($id);

        // Remove file from the public disk if it exists
        if ($audio->filename && Storage::disk('public')->exists('audio/' . $audio->filename)) {
            Storage::disk('public')->delete('audio/' . $audio->filename);
        }

        // Delete database record
        $audio->delete();

        // Return JSON for AJAX requests, otherwise redirect back to list
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Audio deleted'], 200);
        }

        return redirect()->route('audio.list')->with('success', 'Audio deleted');
    }
}
