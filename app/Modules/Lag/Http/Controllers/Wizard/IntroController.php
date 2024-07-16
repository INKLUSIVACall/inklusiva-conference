<?php

namespace App\Modules\Lag\Http\Controllers\Wizard;

use App\Modules\Lag\Helpers\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntroController
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
        }

        // try to get old userData from session
        $userData = session()->get('userData');
        // Always overwrite the old userData with the current defaults.
        UserData::fill($userData, $role);

        session()->put('userData', $userData);

        $numberOfSteps = $this->getNumberOfStepsByRole($role);

        return view('lag::wizard.intro', [
            'meeting' => $meeting,
            'userData' => $userData,
            'hideSkipNav' => true,
            'role' => $role ?? null,
            'numberOfSteps' => $numberOfSteps,
        ]);
    }

    public function store(Request $request)
    {
        $targetStep = $request->targetStep;

        if ($request->meeting_id !== null) {
            [$meeting, $role] = $this->getMeetingAndRole($request->meeting_id);
        } else {
            $meeting = null;
            $role = null;
        }

        $validationRules = [
            'datenschutz' => 'required',
        ];
        $validationMessages = [
            'datenschutz.required' => 'Bitte stimmen Sie der Datenschutzerklärung zu.',
        ];
        if ($request->mode === 'upload') {
            $validationRules['upload'] = 'required';
            $validationMessages['upload.required'] = 'Bitte wählen Sie eine Datei aus.';
        }
        if ($meeting !== null) {
            if ($meeting->should_record) {
                $validationRules['recordingConsent'] = 'required';
                $validationMessages['recordingConsent.required'] = 'Bitte stimmen Sie der Aufzeichnung des Meetings zu. Dann kann es weitergehen.';
            }
        }

        $validator = Validator::make($request->all(), $validationRules, $validationMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('role', $targetStep);
        }

        // Überschreibe vorhandene Felder in Session mit neuen Daten aus Request. Dies fügt außerdem den CSRF-Token hinzu.
        $userDataOld = session()->get('userData');
        $userData = array_replace_recursive($userDataOld, $request->all());

        unset($userData['_token']);
        session()->put('userData', $userData);

        $messages = [];
        $errors = [];
        switch ($request->mode) {
            case 'base':
                // if there are any saved settings, they need to be added to the session.
                if ($request->userData !== null) {
                    $userData = json_decode($request->userData, true);
                    $userData['role'] = $role;
                    session()->put('userData', $userData);
                }
                // otherwise do nothing.
                break;
            case 'individual':
                // reset session
                $userData = [];
                UserData::fill($userData, $role);
                session()->put('userData', $userData);
                break;
            case 'upload':
                if ($request->file('upload') !== null) {
                    $userData = json_decode(file_get_contents($request->file('upload')), true);
                    if ($userData === null) {
                        $userData['targetStep'] = 'intro';
                        array_push($errors, ['upload' => __('wizard/step1.errors.invalidFile')]);
                    } else {
                        $userData['targetStep'] = 'summary';
                        $userData['role'] = $role;
                        session()->put('userData', $userData);
                        array_push($messages, __('wizard/step1.messages.uploadSuccess'));
                    }
                } else {
                    $userData['targetStep'] = 'intro';
                    array_push($errors, ['upload' => __('wizard/step1.errors.noFile')]);
                }
                break;

            default:
                // code...
                break;
        }

        return redirect(
            route('lag.wizard.'.$targetStep, [
                'id' => $request->meeting_id ?? null,
                'mode' => $request->mode,
            ]))->with('success', $messages);
    }
}
