<?php

namespace App\Modules\Lag\Http\Controllers\Wizard;

use App\Modules\Lag\Helpers\UserData;
use App\Modules\Lag\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaptioningController
{
    use MeetingResolver;
    use StepResolver;

    public function index($id = null)
    {
        $meeting = null;
        $role = null;

        // Try to get the meeting instance by uuid first, then by id.
        // if there is an id supplied but it cannot be matched, abort with 404.
        if ($id !== null) {
            [$meeting, $role] = $this->getMeetingAndRole($id);

            if ($meeting === null || $role !== 'captioner') {
                abort(404, 'Meeting not found.');
            }
        }

        // try to get old userData from session
        $userData = session()->get('userData');
        // session()->put('userData', $userData);
        $numberOfSteps = $this->getNumberOfStepsByRole($role);

        return view('lag::wizard.captioning', [
            'meeting' => $meeting,
            'role' => $role ?? null,
            'userData' => $userData,
            'numberOfSteps' => $numberOfSteps,
        ]);
    }

    public function store(Request $request)
    {
        $targetStep = $request->targetStep;

        $meeting = null;
        if ($request->meeting_id !== null) {
            [$meeting, $role] = $this->getMeetingAndRole($request->meeting_id);
        }

        $validationRules = [
        ];
        $validationMessages = [
        ];

        $validator = Validator::make($request->all(), $validationRules, $validationMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Überschreibe vorhandene Felder in Session mit neuen Daten aus Request. Dies fügt außerdem den CSRF-Token hinzu.
        $userDataOld = session()->get('userData');
        $userData = array_replace_recursive($userDataOld, $request->all());

        if ($userData['assistant']['signLang']['active'] == 1) {
            $userData['assistant']['transcription']['active'] = 1;
        }

        unset($userData['_token']);
        session()->put('userData', $userData);

        return redirect(route('lag.wizard.' . $targetStep, ['id' => $request->meeting_id ?? null]));
    }
}
