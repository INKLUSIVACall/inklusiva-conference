<?php

namespace App\Modules\Lag\Http\Controllers\Wizard;

use App\Modules\Lag\Helpers\Text;
use App\Modules\Lag\Helpers\UserData;
use App\Modules\Lag\Models\Meeting;
use Illuminate\Http\Request;

class SummaryController
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
        if (! isset($userData)) {
            // if there is no old userData after the intro, redirect back to the intro.
            return redirect(route('lag.wizard.intro', ['id' => $id]));
        }

        $summaryContent = [];
        $summaryContent = $this->formatUserdata($userData);

        $numberOfSteps = $this->getNumberOfStepsByRole($role);

        return view('lag::wizard.summary', [
            'meeting' => $meeting,
            'userData' => $userData,
            'content' => $summaryContent,
            'messages' => '',
            'role' => $role ?? null,
            'numberOfSteps' => $numberOfSteps,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->targetStep !== 'meeting') {
            return redirect(route('lag.wizard.'.$request->targetStep, ['id' => $request->meeting_id]));
        }
        // Überschreibe vorhandene Felder in Session mit neuen Daten aus Request. Dies fügt außerdem den CSRF-Token hinzu.
        $userDataOld = session()->get('userData');
        $userData = array_replace_recursive($userDataOld, $request->all());

        unset($userData['_token']);
        // Sonderfall volume: der Wertebereich muss im Wizard 0-100 sein, Jitsi erwartet allerdings den Wertebereich 0-1, somit muss der Wert bevor er in den JWT gepackt wird einmal angepasst werden.
        $userData['audio']['volume'] = $userData['audio']['volume'] / 100;
        session()->put('userData', $userData);

        if ($request->meeting_id === null) {
            return redirect(route('base.home'))->with('success', 'Das Meeting-Profil wurde erfolgreich gespeichert.');
        }

        [$meeting, $role] = $this->getMeetingAndRole($request->meeting_id);

        if (! isset($meeting)) {
            abort(404, 'Meeting not found.');
        }

        $userData['meeting_id'] = $request->meeting_id;
        if ($request->has('transcriptionLink')) {
            $userData['transcriptionLink'] = $request->transcriptionLink;
        }
        $url = $meeting->getJitsiLink($userData, $meeting);

        if ($meeting !== null) {
            return redirect($url);
        } else {
            abort(404, 'Meeting not found.');
        }
    }

    public function formatUserdata($userData)
    {
        $summaryContent = [];

        $summaryContent['user'][__('wizard/summary.user.identifier')] = ['icon' => 'fa-solid fa-user', 'value' => $userData['name'], 'ariaLabelForTitle' => __('wizard/summary.user.ariaLabel') .$userData['name']];

        $summaryContent['user'][__('wizard/summary.support.identifier')] = ['icon' => 'fa-solid fa-book', 'value' => Text::getStringByContext(Text::CONTEXT_SUPPORT_NEED, $userData['support']['learning_difficulties']),
            'ariaLabelForTitle' => __('wizard/summary.support.ariaLabel') .Text::getStringByContext(Text::CONTEXT_SUPPORT_NEED, $userData['support']['learning_difficulties'])];

        // UI
        $summaryContent['ui'][__('wizard/summary.ui.fontSize')] = ['icon' => 'fa-solid fa-text-height', 'value' => UserData::POSSIBLE_VALUES_UI_FONT_SIZE[$userData['ui']['fontSize']],
            'ariaLabelForTitle' => __('wizard/summary.ui.fontSize.ariaLabel').UserData::POSSIBLE_VALUES_UI_FONT_SIZE[$userData['ui']['fontSize']]];
        $summaryContent['ui'][__('wizard/summary.ui.iconSize')] = ['icon' => 'fa-solid fa-up-down', 'value' => UserData::POSSIBLE_VALUES_UI_ICON_SIZE[$userData['ui']['iconSize']],
            'ariaLabelForTitle' => __('wizard/summary.ui.iconSize.ariaLabel').UserData::POSSIBLE_VALUES_UI_ICON_SIZE[$userData['ui']['iconSize']]];
        $summaryContent['ui'][__('wizard/summary.ui.visualCues')] = ['icon' => 'fa-solid fa-eye', 'value' => Text::getStringByContext(Text::CONTEXT_ISON, $userData['ui']['visualCues']),
            'ariaLabelForTitle' => __('wizard/summary.ui.visualCues.ariaLabel').Text::getStringByContext(Text::CONTEXT_ISON, $userData['ui']['visualCues'])];
        $summaryContent['ui'][__('wizard/summary.ui.acousticCues')] = ['icon' => 'fa-solid fa-bell', 'value' => Text::getStringByContext(Text::CONTEXT_ISON, $userData['ui']['acousticCues']),
            'ariaLabelForTitle' => __('wizard/summary.ui.acousticCues.ariaLabel').Text::getStringByContext(Text::CONTEXT_ISON, $userData['ui']['acousticCues'])];

        // VIDEO
        $summaryContent['video'][__('wizard/summary.video.otherParticipants')] = ['icon' => 'fa-solid fa-users-between-lines', 'value' => Text::getStringByContext(Text::CONTEXT_ISON, $userData['video']['otherParticipants']),
            'ariaLabelForTitle' => __('wizard/summary.video.otherParticipants.ariaLabel').Text::getStringByContext(Text::CONTEXT_ISON, $userData['video']['otherParticipants'])];
        if ($userData['video']['otherParticipants']) {
            $summaryContent['video'][__('wizard/summary.video.contrast')] = ['icon' => 'fa-solid fa-circle-half-stroke', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['contrast']),
                'ariaLabelForTitle' => __('wizard/summary.video.contrast.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['contrast'])];
            $summaryContent['video'][__('wizard/summary.video.brightness')] = ['icon' => 'fa-solid fa-bolt-lightning', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['brightness']),
                'ariaLabelForTitle' => __('wizard/summary.video.brightness.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['brightness'])];
            $summaryContent['video'][__('wizard/summary.video.dimming')] = ['icon' => 'fa-solid fa-sun', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['dimming']),
                'ariaLabelForTitle' => __('wizard/summary.video.dimming.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['dimming'])];
            $summaryContent['video'][__('wizard/summary.video.saturation')] = ['icon' => 'fa-solid fa-droplet', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['saturation']),
                'ariaLabelForTitle' => __('wizard/summary.video.saturation.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['saturation'])];
            $summaryContent['video'][__('wizard/summary.video.zoom')] = ['icon' => 'fa-solid fa-magnifying-glass', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['zoom']),
                'ariaLabelForTitle' => __('wizard/summary.video.zoom.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['video']['zoom'])];
        }

        // AUDIO
        $summaryContent['audio'][__('wizard/summary.audio.otherParticipants')] = ['icon' => 'fa-solid fa-wave-square', 'value' => Text::getStringByContext(Text::CONTEXT_ISON, $userData['audio']['otherParticipants']),
            'ariaLabelForTitle' => __('wizard/summary.audio.otherParticipants.ariaLabel').Text::getStringByContext(Text::CONTEXT_ISON, $userData['audio']['otherParticipants'])];
        if ($userData['audio']['otherParticipants']) {
            $summaryContent['audio'][__('wizard/summary.audio.volume')] = ['icon' => 'fa-solid fa-volume-high', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['audio']['volume']),
                'ariaLabelForTitle' => __('wizard/summary.audio.volume.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['audio']['volume'] * 100)];
            $summaryContent['audio'][__('wizard/summary.audio.highFreq')] = ['icon' => 'fa-solid fa-signal', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['audio']['highFreq']),
                'ariaLabelForTitle' => __('wizard/summary.audio.highFreq.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['audio']['highFreq'])];
            $summaryContent['audio'][__('wizard/summary.audio.amplify')] = ['icon' => 'fa-solid fa-volume-low', 'value' => UserData::POSSIBLE_VALUES_AUDIO_AMPLIFY[$userData['audio']['amplify']],
                'ariaLabelForTitle' => __('wizard/summary.audio.amplify.ariaLabel').UserData::POSSIBLE_VALUES_AUDIO_AMPLIFY[$userData['audio']['amplify']]];
            $summaryContent['audio'][__('wizard/summary.audio.balance')] = ['icon' => 'fa-solid fa-compass', 'value' => UserData::POSSIBLE_VALUES_AUDIO_BALANCE[$userData['audio']['balance']],
                'ariaLabelForTitle' => __('wizard/summary.audio.balance.ariaLabel').UserData::POSSIBLE_VALUES_AUDIO_BALANCE[$userData['audio']['balance']]];
            $summaryContent['audio'][__('wizard/summary.audio.background')] = ['icon' => 'fa-solid fa-wind', 'value' => Text::getStringByContext(Text::CONTEXT_ISON, $userData['audio']['background']),
                'ariaLabelForTitle' =>__('wizard/summary.audio.background.ariaLabel') .Text::getStringByContext(Text::CONTEXT_ISON, $userData['audio']['background'])];
            $summaryContent['audio'][__('wizard/summary.audio.output')] = ['icon' => 'fa-solid fa-radio', 'value' => ucfirst($userData['audio']['output']),
                'ariaLabelForTitle' => __('wizard/summary.audio.output.ariaLabel').ucfirst($userData['audio']['output'])];
        }

        // DISTRESSBUTTON
        $summaryContent['distressbutton'][__('wizard/summary.distressbutton.identifier')] = ['icon' => 'fa-solid fa-bell-concierge', 'value' => Text::getStringByContext(Text::CONTEXT_ISACTIVE, $userData['distressbutton']['active']),
            'ariaLabelForTitle' => __('wizard/summary.distressbutton.ariaLabel').Text::getStringByContext(Text::CONTEXT_ISACTIVE, $userData['distressbutton']['active'])];
        if ($userData['distressbutton']['active']) {
            $summaryContent['distressbutton'][__('wizard/summary.distressbutton.dimming')] = ['icon' => 'fa-solid fa-sun', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['distressbutton']['dimming'] ?? '0'),
                'ariaLabelForTitle' => __('wizard/summary.distressbutton.dimming.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['distressbutton']['dimming'] ?? '0')];
            $summaryContent['distressbutton'][__('wizard/summary.distressbutton.volume')] = ['icon' => 'fa-solid fa-volume-low', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['distressbutton']['volume'] ?? '0'),
                'ariaLabelForTitle' => __('wizard/summary.distressbutton.volume.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['distressbutton']['volume'] ?? '0')];
            $summaryContent['distressbutton'][__('wizard/summary.distressbutton.message_active')] = ['icon' => 'fa-solid fa-paper-plane', 'value' => Text::getStringByContext(Text::CONTEXT_ISACTIVE, ($userData['distressbutton']['message_active']) ?? 'Ja'),
                'ariaLabelForTitle' => __('wizard/summary.distressbutton.message_active.ariaLabel').Text::getStringByContext(Text::CONTEXT_ISACTIVE, ($userData['distressbutton']['message_active']) ?? 'Ja')];
            if (isset($userData['distressbutton']['message_active'])) {
                $summaryContent['distressbutton'][__('wizard/summary.distressbutton.message_text')] = ['icon' => 'fa-solid fa-envelope', 'value' => $userData['distressbutton']['message_text'] ?? '',
                    'ariaLabelForTitle' => __('wizard/summary.distressbutton.message_text.ariaLabel').$userData['distressbutton']['message_text']];
            }
        }

        // ASSISTANTS
        if ($userData['assistant']['signLang']['active']) {
            $summaryContent['assistants'][__('wizard/summary.assistants.signLang.display')] = ['icon' => 'fa-solid fa-photo-film', 'value' => Text::getStringByContext(Text::CONTEXT_ASSISTANTS, $userData['assistant']['signLang']['display']),
                'ariaLabelForTitle' => __('wizard/summary.assistants.signLang.display.ariaLabel').Text::getStringByContext(Text::CONTEXT_ASSISTANTS, $userData['assistant']['signLang']['display'])];
            $summaryContent['assistants'][__('wizard/summary.assistants.signLang.windowSize')] = ['icon' => 'fa-solid fa-window-maximize', 'value' => Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['assistant']['signLang']['windowSize']),
                'ariaLabelForTitle' => __('wizard/summary.assistants.signLang.windowSize.ariaLabel').Text::getStringByContext(Text::CONTEXT_HASPERCENT, $userData['assistant']['signLang']['windowSize'])];
        }

        $summaryContent['captioning'][__('wizard/summary.captioning.identifier')] = ['icon' => 'fa-solid fa-book-open', 'value' => $userData['transcriptionLink'] ?? ''];


        return $summaryContent;
    }
}
