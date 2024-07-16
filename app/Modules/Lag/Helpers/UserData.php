<?php

namespace App\Modules\Lag\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserData
{
    public const VALIDATION_NAME = ['name' => ['required', 'string']];
    public const VALIDATION_MODE = ['mode' => ['required', 'string', 'in:base,individual,saved,upload']];

    public const VALIDATION_SUPPORT_EYESIGHT = ['support.eyesight' => ['required', 'string', 'in:normal,visually_impaired,blind']];
    public const VALIDATION_SUPPORT_HEARING = ['required', 'string', 'in:normal,hearing_impaired,deaf'];
    public const VALIDATION_SUPPORT_SENSES = ['boolean'];
    public const VALIDATION_SUPPORT_LEARNING_DIFFICULTIES = ['boolean'];

    public const VALIDATION_UI_FONT_SIZE = ['type' => 'integer', 'min' => 50, 'max' => 200, 'steps' => 10];
    public const VALIDATION_UI_ICON_SIZE = ['type' => 'integer', 'min' => 1, 'max' => 3, 'steps' => 1];
    public const VALIDATION_UI_SCREEN_READER = ['boolean'];
    public const VALIDATION_UI_VISUAL_CUES = ['boolean'];
    public const VALIDATION_UI_ACOUSTIC_CUES = ['boolean'];

    public const VALIDATION_VIDEO_OTHER_PARTICIPANTS = ['boolean'];
    public const VALIDATION_VIDEO_CONTRAST = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_VIDEO_BRIGHTNESS = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_VIDEO_DIMMING = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_VIDEO_SATURATION = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_VIDEO_ZOOM = ['integer', 'min' => 0, 'max' => 200, 'steps' => 10];
    public const VALIDATION_VIDEO_FPS = ['integer', 'min' => 1, 'max' => 30, 'steps' => 1];

    public const VALIDATION_AUDIO_VOLUME = ['integer', 'min' => 0, 'max' => 1, 'steps' => 0.1];
    public const VALIDATION_AUDIO_HIGH_FREQUENCIES = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_AUDIO_AMPLIFY = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_AUDIO_BALANCE = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_AUDIO_BACKGROUND = ['boolean'];
    public const VALIDATION_AUDIO_OUTPUT = ['string', ['stereo', 'mono']];

    public const VALIDATION_DISTRESSBUTTON_ACTIVE = ['boolean'];
    public const VALIDATION_DISTRESSBUTTON_DIMMING = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_DISTRESSBUTTON_VOLUME = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_DISTRESSBUTTON_MESSAGE = ['boolean'];
    public const VALIDATION_DISTRESSBUTTON_MESSAGE_TEXT = ['string'];

    public const VALIDATION_ASSISTANT_SIGNLANG_ACTIVE = ['boolean'];
    public const VALIDATION_ASSISTANT_SIGNLANG_DISPLAY = ['string', ['tile', 'window']];
    public const VALIDATION_ASSISTANT_SIGNLANG_WINDOW_SIZE = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_ASSISTANT_TRANSCRIPTION_ACTIVE = ['boolean'];
    public const VALIDATION_ASSISTANT_TRANSCRIPTION_FONT_SIZE = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];
    public const VALIDATION_ASSISTANT_TRANSCRIPTION_HISTORY = ['integer', 'min' => 0, 'max' => 100, 'steps' => 10];

    ////////////////////////////
    // DEFAULT VALUES
    ////////////////////////////

    public const DEFAULT_SUPPORT_EYESIGHT = 'normal';
    public const DEFAULT_SUPPORT_HEARING = 'normal';
    public const DEFAULT_SUPPORT_SENSES = false;
    public const DEFAULT_SUPPORT_LEARNING_DIFFICULTIES = false;
    public const DEFAULT_SUPPORT_SCREEN_READER = false;

    public const DEFAULT_UI_FONT_SIZE = 1;
    public const DEFAULT_UI_ICON_SIZE = 1;
    public const DEFAULT_UI_VISUAL_CUES = true;
    public const DEFAULT_UI_ACOUSTIC_CUES = true;

    public const DEFAULT_VIDEO_OTHER_PARTICIPANTS = true;
    public const DEFAULT_VIDEO_CONTRAST = 100;
    public const DEFAULT_VIDEO_BRIGHTNESS = 100;
    public const DEFAULT_VIDEO_DIMMING = 0;
    public const DEFAULT_VIDEO_SATURATION = 100;
    public const DEFAULT_VIDEO_ZOOM = 100;
    //public const DEFAULT_VIDEO_FPS = 15;

    public const DEFAULT_AUDIO_OTHER_PARTICIPANTS = true;
    public const DEFAULT_AUDIO_VOLUME = 100;
    public const DEFAULT_AUDIO_HIGH_FREQUENCIES = 0;
    public const DEFAULT_AUDIO_AMPLIFY = 0;
    public const DEFAULT_AUDIO_BALANCE = 2;
    public const DEFAULT_AUDIO_BACKGROUND = false;
    public const DEFAULT_AUDIO_OUTPUT = 'stereo';

    public const DEFAULT_DISTRESSBUTTON_ACTIVE = false;
    public const DEFAULT_DISTRESSBUTTON_DIMMING = 0;
    public const DEFAULT_DISTRESSBUTTON_VOLUME = 0;
    public const DEFAULT_DISTRESSBUTTON_MESSAGE = false;
    public const DEFAULT_DISTRESSBUTTON_MESSAGE_TEXT = 'Liebe Begleitperson, ich habe gerade den Notfall-Knopf geklickt. Ich möchte (…)';

    public const DEFAULT_ASSISTANT_SIGNLANG_ACTIVE = true;
    public const DEFAULT_ASSISTANT_SIGNLANG_DISPLAY = 'tile';
    public const DEFAULT_ASSISTANT_SIGNLANG_WINDOW_SIZE = 100;
    public const DEFAULT_ASSISTANT_TRANSCRIPTION_ACTIVE = false;
    public const DEFAULT_ASSISTANT_TRANSCRIPTION_FONT_SIZE = 0;
    public const DEFAULT_ASSISTANT_TRANSCRIPTION_HISTORY = 0;

    ////////////////////////////
    // SLIDER POSSIBLE VALUES
    ////////////////////////////

    public const POSSIBLE_VALUES_UI_FONT_SIZE = ['klein', 'mittel', 'groß'];
    public const POSSIBLE_VALUES_UI_ICON_SIZE = ['klein', 'mittel', 'groß'];
    public const POSSIBLE_VALUES_AUDIO_AMPLIFY = ['aus', 'leise', 'mittel', 'laut'];
    public const POSSIBLE_VALUES_AUDIO_BALANCE = ['links', 'links-mitte', 'mitte', 'rechts-mitte', 'rechts'];
    public const POSSIBLE_VALUES_ASSISTANT_TRANSCRIPTION_FONT_SIZE = ['klein', 'mittel', 'groß'];
    public const POSSIBLE_VALUES_ASSISTANT_TRANSCRIPTION_HISTORY = ['kurz', 'mittel', 'lang'];

    // Contains the validation rules for each step. Must be in the correct order because they get added programmatically.
    public const STEP_CONFIGURATIONS = [
        [
            'step' => 'intro',
            'rules' => [],
        ],
        [
            'step' => 'step1',
            'rules' => [
                'name' => 'required'
            ],
        ],
        [
            'step' => 'step2',
            'rules' => [
                'mode' => 'required|string|in:base,individual,saved,upload'
            ],
        ],
        [
            'step' => 'step3',
            'rules' => [
                'support.eyesight' => 'required|string|in:normal,visually_impaired,blind',
                'support.hearing' => 'required|string|in:normal,hearing_impaired,deaf',
                'support.senses' => 'boolean',
                'support.learning_difficulties' => 'boolean',
            ],
        ],
        [
            'step' => 'step4',
            'rules' => [
                'ui.fontSize' => 'integer|min:0|max:3',
                'ui.iconSize' => 'integer|min:0|max:3',
                'ui.screenreader' => 'boolean',
                'ui.visualCues' => 'boolean',

                'video.otherParticipants' => 'boolean',
                'video.contrast' => 'integer|min:0|max:100',
                'video.brightness' => 'integer|min:0|max:100',
                'video.dimming' => 'integer|min:0|max:100',
                'video.saturation' => 'integer|min:0|max:100',
                'video.zoom' => 'integer|min:0|max:200',
                //'video.fps' => 'integer|min:1|max:30',
            ],
        ],
        [
            'step' => 'step5',
            'rules' => [
                'audio.otherParticipants' => 'boolean',
                'audio.volume' => 'integer|min:0|max:1',
                'audio.highFreq' => 'integer|min:0|max:100',
                'audio.amplify' => 'integer|min:0|max:4',
                'audio.balance' => 'integer|min:0|max:5',
                'audio.background' => 'boolean',
                'audio.output' => 'string|in:stereo,mono',
            ],
        ],
        [
            'step' => 'step6',
            'rules' => [
                'distressbutton.active' => 'boolean',
            ],
        ],
        [
            'step' => 'step6_2',
            'rules' => [
                'distressbutton.dimming' => 'integer|min:0|max:100',
                'distressbutton.volume' => 'integer|min:0|max:100',
                'distressbutton.message' => 'boolean',
                'distressbutton.message_text' => 'required_if:distressbutton.message,true',
            ]
        ],
        [
            'step' => 'step7',
            'rules' => [
                'assistant.signLang.active' => 'boolean',
                'assistant.transcription.active' => 'boolean',
            ],
        ],
        [
            'step' => 'step7_2',
            'rules' => [],
        ],
        [
            'step' => 'summary',
            'rules' => [],
        ],
        [
            'step' => 'done',
            'rules' => [],
        ],
    ];

    /**
     * Checks validity for any given userData-object, no matter which step it is in.
     * @return bool | ValidtionError
     */
    public static function ensureValidity($userData)
    {
        // make a validator that contains the rules for all the steps until currentStep.
        $validator = Validator::make($userData, self::getValidationRulesUntilCurrentStep($userData['currentStep']));

        if ($validator->fails()) {
            return $validator->errors();
        }
        return [];
    }


    public static function fill(&$userData, $role = null)
    {
        if ($role !== null) {
            $userData['role'] = $role;
        }
        $userData['currentStep'] = 'step2';
        $userData['mode'] = 'base';
        $userData['support']['eyesight'] = self::DEFAULT_SUPPORT_EYESIGHT;
        $userData['support']['hearing'] = self::DEFAULT_SUPPORT_HEARING;
        $userData['support']['senses'] = self::DEFAULT_SUPPORT_SENSES;
        $userData['support']['learning_difficulties'] = self::DEFAULT_SUPPORT_LEARNING_DIFFICULTIES;
        $userData['support']['screenreader'] = self::DEFAULT_SUPPORT_SCREEN_READER;
        $userData['ui']['fontSize'] = self::DEFAULT_UI_FONT_SIZE;
        $userData['ui']['iconSize'] = self::DEFAULT_UI_ICON_SIZE;
        $userData['ui']['visualCues'] = self::DEFAULT_UI_VISUAL_CUES;
        $userData['ui']['acousticCues'] = self::DEFAULT_UI_ACOUSTIC_CUES;
        $userData['video']['otherParticipants'] = self::DEFAULT_VIDEO_OTHER_PARTICIPANTS;
        $userData['video']['contrast'] = self::DEFAULT_VIDEO_CONTRAST;
        $userData['video']['brightness'] = self::DEFAULT_VIDEO_BRIGHTNESS;
        $userData['video']['dimming'] = self::DEFAULT_VIDEO_DIMMING;
        $userData['video']['saturation'] = self::DEFAULT_VIDEO_SATURATION;
        $userData['video']['zoom'] = self::DEFAULT_VIDEO_ZOOM;
        //$userData['video']['fps'] = self::DEFAULT_VIDEO_FPS;
        $userData['audio']['otherParticipants'] = self::DEFAULT_AUDIO_OTHER_PARTICIPANTS;
        $userData['audio']['volume'] = self::DEFAULT_AUDIO_VOLUME;
        $userData['audio']['highFreq'] = self::DEFAULT_AUDIO_HIGH_FREQUENCIES;
        $userData['audio']['amplify'] = self::DEFAULT_AUDIO_AMPLIFY;
        $userData['audio']['balance'] = self::DEFAULT_AUDIO_BALANCE;
        $userData['audio']['background'] = self::DEFAULT_AUDIO_BACKGROUND;
        $userData['audio']['output'] = self::DEFAULT_AUDIO_OUTPUT;
        $userData['distressbutton']['active'] = self::DEFAULT_DISTRESSBUTTON_ACTIVE;
        $userData['distressbutton']['dimming'] = self::DEFAULT_DISTRESSBUTTON_DIMMING;
        $userData['distressbutton']['volume'] = self::DEFAULT_DISTRESSBUTTON_VOLUME;
        $userData['distressbutton']['message'] = self::DEFAULT_DISTRESSBUTTON_MESSAGE;
        $userData['distressbutton']['messageText'] = self::DEFAULT_DISTRESSBUTTON_MESSAGE_TEXT;
        $userData['assistant']['signLang']['active'] = self::DEFAULT_ASSISTANT_SIGNLANG_ACTIVE;
        $userData['assistant']['signLang']['display'] = self::DEFAULT_ASSISTANT_SIGNLANG_DISPLAY;
        $userData['assistant']['signLang']['windowSize'] = self::DEFAULT_ASSISTANT_SIGNLANG_WINDOW_SIZE;
        $userData['assistant']['transcription']['active'] = self::DEFAULT_ASSISTANT_TRANSCRIPTION_ACTIVE;
        $userData['assistant']['transcription']['fontSize'] = self::DEFAULT_ASSISTANT_TRANSCRIPTION_FONT_SIZE;
        $userData['assistant']['transcription']['history'] = self::DEFAULT_ASSISTANT_TRANSCRIPTION_HISTORY;
    }

    /**
     * Return a validator that checks if the currentStep field is set and contains the correct value.
     */
    public static function buildValidatorForCurrentStep($currentStep)
    {
        return ['currentStep' => ['required', 'string', Rule::in($currentStep)]];
    }

    /**
     * Builds an array of validation rules for all steps until the current step.
     */
    public static function getValidationRulesUntilCurrentStep($currentStep)
    {
        $rules = [];

        foreach (self::STEP_CONFIGURATIONS as $config) {
            foreach ($config['rules'] as $field => $rule) {
                $rules[$field] = $rule;
            }

            if ($config['step'] == $currentStep) {
                return $rules;
            }
        }
        return $rules;
    }
}
