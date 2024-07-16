<?php

namespace App\Modules\Lag\Http\Controllers\Wizard;

use App\Mail\EndScreenFeedback;
use App\Models\User;
use App\Modules\Lag\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EndscreenController
{
    use MeetingResolver;

    public function index($meetingId, $thankYou = false)
    {
        [$meeting, $role] = $this->getMeetingAndRole($meetingId);

        $videoFile = storage_path('app/recordings/' . $meeting->id . '/video.mp4');
        $videoDirExists = is_dir(storage_path('app/recordings/' . $meeting->id));

        return view('lag::wizard.endscreen', [
            'meeting' => $meeting,
            'thankYou' => $thankYou,
            'meetingId' => $meetingId,
            'videoDirExists' => $videoDirExists,
            'recordingExists' => file_exists($videoFile),
            'recordingPath' => $videoFile,
        ]);
    }

    public function store(Request $request, $meetingId)
    {
        [$meeting, $role] = $this->getMeetingAndRole($meetingId);
        $validatedData = $request->validate([
            'rating' => 'integer|min:0|max:5',
            'barrier' => 'nullable|string',
        ]);

        $roleName = '';
        switch ($role) {
            case Meeting::ROLE_MODERATOR:
                $roleName = 'Moderator';
                break;
            case Meeting::ROLE_CO_MODERATOR:
                $roleName = 'Co-Moderator';
                break;
            case Meeting::ROLE_PARTICIPANT:
                $roleName = 'Teilnehmer';
                break;
            case Meeting::ROLE_SIGN_LANG_TRANSLATOR:
                $roleName = 'Gebärdensprachdolmetscher';
                break;
            case Meeting::ROLE_CAPTIONER:
                $roleName = 'Schriftdolmetscher';
                break;
        }

        $rating = $validatedData['rating'] != '0' ? $validatedData['rating'] : 'keine Bewertung';
        $message = $validatedData['barrier'] != null ? $validatedData['barrier'] : 'keine Meldung';

        if ($validatedData['rating'] != '0' || $validatedData['barrier'] != null) {
            if (env('FILTER_4MORGEN_ADMINS', true)) {
                $adminUsers = User::role('admin')->where('email', 'not like', '%viermorgen%')->get();
            } else {
                $adminUsers = User::role('admin')->get();
            }
            foreach ($adminUsers as $adminUser) {
                Mail::to($adminUser->email)->send(new EndScreenFeedback($meeting, $roleName, $rating, $message));
            }
        }

        return redirect(route('endscreen', ['meeting' => $meetingId, 'thankyou' => true]));
    }

    public function refreshVideoState($meetingId)
    {
        [$meeting, $role] = $this->getMeetingAndRole($meetingId);

        $videoFile = storage_path('app/recordings/' . $meeting->id . '/video.mp4');
        $videoDirExists = is_dir(storage_path('app/recordings/' . $meeting->id));

        return view('lag::wizard.videostate', [
            'meetingId' => $meetingId,
            'videoDirExists' => $videoDirExists,
            'recordingExists' => file_exists($videoFile),
            'recordingPath' => $videoFile,
        ]);
    }
}
