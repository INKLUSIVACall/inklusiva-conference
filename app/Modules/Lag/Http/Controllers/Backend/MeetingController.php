<?php

namespace App\Modules\Lag\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequest;
use App\Modules\Lag\Helpers\Meeting as MeetingHelper;
use App\Modules\Lag\Http\Controllers\Wizard\MeetingResolver;
use App\Modules\Lag\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MeetingController extends Controller
{
    use MeetingResolver;
    /**
     * List all Meetings of the user.
     */
    public function index()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();

        // Anzeige aller Meetings des Nutzers, wo start entweder null ist, oder nicht älter als 2 Tage
        $meetings = $user->meetings()->running()->get();

        // Meeting nach start absteigend sortieren, aber Meetings mit start = null immer am Anfang
        $meetings = $meetings->sortByDesc(function ($meeting) {
            return $meeting->start ? $meeting->start->timestamp : 0;
        });

        $laodAvg = sys_getloadavg();

        return view('lag::meeting.index', [
            'meetings' => $meetings,
            'loadAvg' => $laodAvg,
            'success' => Session::get('success'),
        ]);
    }

    /**
     * Create new meeting.
     */
    public function create()
    {
        return view('lag::meeting.create');
    }

    /**
     * Store new meeting.
     */
    public function store(MeetingRequest $request)
    {
        $meeting = new Meeting();
        $meeting->fill($request->all());

        if ($request->get('meetingtype') !== 'persistent') {
            $meeting->start = $request->get('start_date'). ' ' . $request->get('start_time');
        }

        $meeting->creator()->associate(Auth::user());
        $meeting->uuid = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_comoderator = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_participant = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_signlang_translator = (string) \Illuminate\Support\Str::uuid();
        $meeting->uuid_captioner = (string) \Illuminate\Support\Str::uuid();
        $meeting->save();

        $meeting->name_display = $request->name;

        //$meeting->name = $meeting->name.' '.$meeting->id;
        $meeting->jitsi_room_name = $meeting->proposeJitsiRoomName();

        $meeting->phone_id = MeetingHelper::generateNewPhoneId();

        $meeting->save();

        return redirect()->route('lag.meeting.index')->with('success', 'Das Meeting wurde erfolgreich erstellt.');
    }

    /**
     * Confirm destroy of meeting.
     */
    public function confirmDestroy($id)
    {
        $meeting = Meeting::findOrFail($id);

        return view('lag::meeting.destroy', ['meeting' => $meeting]);
    }

    /**
     * Destroy meeting.
     */
    public function destroy()
    {
        $meeting = Meeting::findOrFail(request()->id);
        $meeting->delete();

        return redirect()->route('lag.meeting.index')->with('success', 'Das Meeting wurde erfolgreich gelöscht.');
    }

    /**
     * Open view to edit meeting.
     */
    public function edit(Meeting $meeting)
    {
        return view('lag::meeting.edit', ['meeting' => $meeting]);
    }

    /**
     * Save changes of meeting.
     */
    public function update(MeetingRequest $request, Meeting $meeting)
    {
        $meeting->fill($request->all());
        $meeting->name_display = $request->name;
        $meeting->name = $meeting->name.' '.$meeting->id;
        if ($request->get('meetingtype') !== 'persistent') {
            $meeting->start = $request->get('start_date'). ' ' . $request->get('start_time');
        }
        $meeting->save();

        return redirect()->route('lag.meeting.index')->with('success', 'Das Meeting wurde erfolgreich aktualisiert.');
    }

    /**
     * Show detail view of meeting.
     */
    public function detail(Meeting $meeting)
    {
        return view('lag::meeting.detail', ['meeting' => $meeting]);
    }

    /**
     * Create a mail-template for the meeting.
     */
    public function createMailTemplate(Meeting $meeting, $role, $link)
    {
        $link = route('lag.wizard.intro', ['id' => $link]);
        [$templateText, $roleName] = $meeting->getMailTemplateAndRoleName($role, $link);

        return view('lag::meeting.mail-template', ['meeting' => $meeting, 'role' => $role, 'templateText' => $templateText, 'roleName' => $roleName]);
    }

    public function downloadRecording($meetingId)
    {
        [$meeting, $role] = $this->getMeetingAndRole($meetingId);

        $videoFile = storage_path('app/recordings/'.$meeting->id.'/video.mp4');

        if (file_exists($videoFile)) {
            return response()->download($videoFile, 'Aufzeichnung ' . $meeting->name_display . '.mp4');
        }

    }
}
