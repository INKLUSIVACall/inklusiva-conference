<?php

namespace App\Modules\Lag\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TempUser;
use App\Modules\Lag\Helpers\Meeting as MeetingHelper;
use App\Modules\Lag\Http\Controllers\Wizard\MeetingResolver;
use App\Modules\Lag\Http\Requests\InstantMeetingRequest;
use App\Modules\Lag\Models\Meeting;
use Carbon\Carbon;

class InstantMeetingController extends Controller
{
    use MeetingResolver;

    public function register()
    {
        return view('lag::instantmeeting.register');
    }

    public function sendRegistration(InstantMeetingRequest $request)
    {
        // initialize new User
        $newTempUser = new TempUser();
        $newTempUser->fill($request->all());
        $newTempUser->salutation = '';
        $newTempUser->name = $request->firstname.' '.$request->lastname;
        $newTempUser->save();

        // initialize new Meeting
        $meeting = new Meeting();
        $meeting->name = $request->meetingTitle;
        $meeting->start = Carbon::now();
        $meeting->tempCreator()->associate($newTempUser);
        // sign language interpreter and text interpreter are always true for instant meetings
        $meeting->sign_language_interpreter = true;
        $meeting->text_interpreter = true;
        $meeting->uuid = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_comoderator = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_participant = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_captioner = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_signlang_translator = (string) \Illuminate\Support\Str::uuid();
        $meeting->save();

        $meeting->phone_id = MeetingHelper::generateNewPhoneId();

        $meeting->name_display = $meeting->name;

        //$meeting->name = $meeting->name.' '.$meeting->id;
        $meeting->jitsi_room_name = $meeting->proposeJitsiRoomName();

        $meeting->save();

        $newTempUser->sendRegistrationPendingNotification($meeting);

        return view('lag::instantmeeting.success');
    }

    public function showMeeting($meetinguuid)
    {
        $meeting = Meeting::where('uuid', $meetinguuid)->first();

        // Wenn ein normaler Creator existiert oder kein temporärer Creator existiert dann ist es kein Instant Meeting -> abort.
        if ($meeting->creator_id !== null || $meeting->temp_creator_id === null) {
            abort(404, 'Meeting not found.');
        }

        return view('lag::instantmeeting.show', ['meeting' => $meeting]);
    }
}
