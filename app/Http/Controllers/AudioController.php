<?php

namespace App\Http\Controllers;


use Exception;
use FFMpeg\FFProbe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudioController extends Controller
{
    public function index()
    {
        return view('pages.audio');
    }

    private function getAudioPlayTime($filePath)
    {
        $ffprobe = FFProbe::create();
        $seconds = $ffprobe->format($filePath)->get('duration');
        return gmdate("H:i:s", (int)$seconds);
    }

    public function getAudioDuration(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'audio' => 'required|file|mimes:mp3,wav,ogg|max:20480',
            ]);

            if ($validate->fails()) {
                $errorMessage = $validate->errors()->first();
                return redirect()->back()->withInput()->with('error', $errorMessage);
            }

            $file = $request->file('audio');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('audios', $filename, 'public');
            $fullPath = storage_path('app/public/' . $filePath);
            $duration = $this->getAudioPlayTime($fullPath);
            $cmd = "ffprobe -v quiet -print_format json -show_format -show_streams \"$fullPath\"";
            $output = shell_exec($cmd);
            $data = json_decode($output, true);
            unlink($fullPath);
            $format = $data['format'] ?? [];
            $stream = $data['streams'][0] ?? [];

            $audioInfo = [
                'duration'   => isset($format['duration']) ? gmdate("H:i:s", (float)$format['duration']) : 'N/A',
                'format'     => $format['format_name'] ?? 'N/A',
                'filesize'   => isset($format['size']) ? round($format['size'] / 1024, 2) . ' KB' : 'N/A',
            ];
            return redirect()->route('audio')->with('audioInfo', $audioInfo);
        } catch (Exception $err) {
            return redirect()->back()->withInput()->with('error', $err->getMessage());
        }
    }
}
