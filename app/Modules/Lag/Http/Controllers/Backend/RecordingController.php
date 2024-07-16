<?php

namespace App\Modules\Lag\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Modules\Lag\Models\Meeting;
use App\Modules\Lag\Models\Recording;
use Illuminate\Support\Facades\Auth;

class RecordingController extends Controller
{
    public function index()
    {
        $recordings = Recording::all();

        return view('lag::recording.index', [
            'recordings' => $recordings,
            'success' => session('success'),
        ]);
    }

    public function detail($id)
    {
        $recording = Recording::find($id);

        return view('lag::recording.detail', ['recording' => $recording]);
    }

    public function confirmDestroy(Recording $recording)
    {
        return view('lag::recording.destroy', ['recording' => $recording]);
    }

    public function destroy(Recording $recording)
    {

        $meeting = Meeting::where('uuid', $recording->meetingUUID)->first();
        $videoFile = storage_path('app/recordings/'.$meeting->id . '/video.mp4');
        if (file_exists($videoFile)) {
            unlink($videoFile);
        }
        // delete directory
        rmdir(storage_path('app/recordings/'.$meeting->id));

        return redirect()->route('lag.recording.index')->with('success', 'Die Aufnahme wurde erfolgreich gelöscht.');
    }

    public function mailTemplate(Recording $recording)
    {
         $link = route('meeting.download', ['meeting' => $recording->meetingUUID]);
        $templateText = $recording->getMailTemplate($link);

        return view('lag::recording.mail-template', ['recording' => $recording, 'templateText' => $templateText]);
    }
}
