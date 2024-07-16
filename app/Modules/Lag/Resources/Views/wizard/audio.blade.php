@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection

@section('content')
    <x-component-progressbox wizardStep="3" wizardTotalSteps="{{ $numberOfSteps }}" title="{{ __('wizard/step1.progressbox.title') }}" />

    <x-wizard.component-steps
        active='audio'
        nextStep='distress'
        :meeting="$meeting"
        :role="$role"
    />

    <x-component-descbox
    ariaLabel="{{__('wizard/step5.descbox.ariaLabel')}}"
    title="{{__('wizard/step5.descbox.title')}}"
    format="{{__('wizard/step5.descbox.format')}}"
    desc="{{__('wizard/step5.descbox.desc')}}"
    helpLink="/assistent-fuer-barrierefreiheit/4-hoeren/"
    />

    <x-component-form
    id="stepForm"
    method="post"
    action="{{ route('lag.wizard.audiopost') }}"
    :meeting="$meeting"
    :role="$role"
    >

        <x-component-whitebox
        title="{{__('wizard/step5.whitebox1.title')}}"
        format="{{__('wizard/step5.whitebox1.format')}}"
        ariaLabel="{{__('wizard/step5.whitebox1.ariaLabel')}}"
        >
            <x-inputs.toggle
                elementTitleText="{{__('wizard/step5.acousticCues.label')}}"
                elementTitleSmall=""
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-bell"
                elementDesc="{{__('wizard/step5.acousticCues.description')}}"
                elementId="ui_acousticCues"
                elementName="ui[acousticCues]"
                :value="$userData['ui']['acousticCues'] ?? UserData::DEFAULT_UI_ACOUSTIC_CUES"/>
        </x-component-whitebox>
        <x-component-whitebox
            title="{{__('wizard/step5.whitebox2.title')}}"
            ariaLabel="{{__('wizard/step5.whitebox2.ariaLabel')}}"
            format="{{__('wizard/step5.whitebox2.format')}}"
            >

            <x-inputs.toggle
                elementTitleText="{{__('wizard/step5.audio.otherParticipants.label')}}"
                elementTitleSmall=""
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-wave-square"
                elementDesc="{{__('wizard/step5.audio.otherParticipants.description')}}"
                elementId="audio_otherParticipants"
                elementName="audio[otherParticipants]"
                :value="$userData['audio']['otherParticipants'] ?? UserData::DEFAULT_AUDIO_OTHER_PARTICIPANTS"/>

                <x-inputs.slider
                elementTitleText="{{__('wizard/step5.audio.volume.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel="true"
                elementId="audio_volume"
                elementIcon="fa-solid fa-volume-high"
                elementName="audio[volume]"
                min="0"
                max="100"
                step="10"
                :value="$userData['audio']['volume'] ?? UserData::DEFAULT_AUDIO_VOLUME"
                unit="%"
                />
                <x-inputs.slider
                elementTitleText="{{__('wizard/step5.audio.highFreq.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel="true"
                elementId="audio_highFreq"
                elementIcon="fa-solid fa-signal"
                elementName="audio[highFreq]"
                min="0"
                max="100"
                step="10"
                :value="$userData['audio']['highFreq'] ?? UserData::DEFAULT_AUDIO_HIGH_FREQUENCIES"
                unit="%"
                />

                <x-inputs.slider
                elementTitleText="{{__('wizard/step5.audio.amplify.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel="true"
                elementId="audio_amplify"
                elementIcon="fa-solid fa-volume-low"
                elementName="audio[amplify]"
                :value="$userData['audio']['amplify'] ?? UserData::DEFAULT_AUDIO_AMPLIFY"
                :possibleValues="UserData::POSSIBLE_VALUES_AUDIO_AMPLIFY"
                />

                <x-inputs.slider
                elementTitleText="{{__('wizard/step5.audio.balance.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel="true"
                elementId="audio_balance"
                elementIcon="fa-solid fa-compass"
                elementName="audio[balance]"
                :value="$userData['audio']['balance'] ?? UserData::DEFAULT_AUDIO_BALANCE"
                :possibleValues="UserData::POSSIBLE_VALUES_AUDIO_BALANCE"
                />

            <x-inputs.toggle
                elementTitleText="{{__('wizard/step5.audio.background.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-wind"
                elementDesc="{{__('wizard/step5.audio.background.description')}}"
                elementId="audio_background"
                elementName="audio[background]"
                :value="$userData['audio']['background'] ?? UserData::DEFAULT_AUDIO_BACKGROUND"
                />

        </x-component-whitebox>
    </x-component-form>
@endsection


