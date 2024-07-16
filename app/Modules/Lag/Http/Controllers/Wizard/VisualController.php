<?php

namespace App\Modules\Lag\Http\Controllers\Wizard;

use Illuminate\Http\Request;

class VisualController
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

            if ($meeting === null) {
                abort(404, 'Meeting not found.');
            }
        } else {
            $meeting = null;
        }

        // try to get old userData from session
        $userData = session()->get('userData');
        if (!isset($userData)) {
            // if there is no old userData after the intro, redirect back to the intro.
            return redirect(route('lag.wizard.intro', ['id' => $id]));
        }

        $numberOfSteps = $this->getNumberOfStepsByRole($role);

        return view('lag::wizard.visual', [
            'meeting' => $meeting,
            'userData' => $userData,
            'role' => $role ?? null,
            'numberOfSteps' => $numberOfSteps,
        ]);
    }

    public function store(Request $request)
    {
        $targetStep = $request->targetStep;

        // Überschreibe vorhandene Felder in Session mit neuen Daten aus Request. Dies fügt außerdem den CSRF-Token hinzu.
        $userDataOld = session()->get('userData');
        $userData = array_replace_recursive($userDataOld, $request->all());

        unset($userData['_token']);
        session()->put('userData', $userData);

        return redirect(route('lag.wizard.' . $targetStep, $request->meeting_id));
    }
}
