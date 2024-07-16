@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection

@section('content')
    <x-component-progressbox wizardStep="4" wizardTotalSteps="{{ $numberOfSteps }}" title="{{ __('wizard/step1.progressbox.title') }}" />

    <x-wizard.component-steps
        active='distress'
        nextStep='translate'
        :meeting="$meeting"
        :role="$role"
    />

    <x-component-descbox
        ariaLabel="{{__('wizard/step6.descbox.ariaLabel')}}"
        format="{{__('wizard/step6.descbox.format')}}"
        title="{{__('wizard/step6.descbox.title')}}"
        desc="{{__('wizard/step6.descbox.desc')}}"
        helpLink="/assistent-fuer-barrierefreiheit/5-notfall/"
    />

    @php
        $distressbuttonActive = false;
        if (isset($userData['distressbutton'])) {
            $distressbuttonActive = $userData['distressbutton']['active'];
        } else {
            if (isset($userData['support']['senses'])) {
                $distressbuttonActive = $userData['support']['senses'];
            } else {
                $distressbuttonActive = App\Modules\Lag\Helpers\UserData::DEFAULT_DISTRESSBUTTON_ACTIVE;
            }
        }
    @endphp

    <x-component-form id="stepForm" method="post" action="{{ route('lag.wizard.distresspost') }}" :meeting="$meeting" :role="$role">
        <x-component-whitebox
        format="{{__('wizard/step6.whitebox1.format')}}"
        title="{{__('wizard/step6.whitebox1.title')}}"
        ariaLabel="{{__('wizard/step6.whitebox1.ariaLabel')}}"
        >
            <x-inputs.toggle
                elementTitleText="{{__('wizard/step6.distressbutton.label')}}"
                elementTitleSmall=""
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-bell-concierge"
                elementDesc="{{__('wizard/step6.distressbutton.description')}}"
                elementId="distressbutton_active"
                elementName="distressbutton[active]"
                :value="$distressbuttonActive"/>

        </x-component-whitebox>

        <x-component-whitebox
            format="{{__('wizard/step6_2.whitebox1.format')}}"
            title="{{__('wizard/step6_2.whitebox1.title')}}"
            id="distressbutton_settings"
            ariaLabel="{{__('wizard/step6_2.whitebox1.ariaLabel')}}">

            <x-inputs.slider
                elementTitleText="{{__('wizard/step6_2.dimming.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel="true"
                elementId="distressbutton_dimming"
                elementIcon="fa-solid fa-sun"
                elementName="distressbutton[dimming]"
                min="0"
                max="100"
                step="10"
                :value="$userData['distressbutton']['dimming'] ?? UserData::DEFAULT_DISTRESSBUTTON_DIMMING"
                unit="%"
            />

            <x-inputs.slider
                elementTitleText="{{__('wizard/step6_2.volume.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel="true"
                elementId="distressbutton_volume"
                elementIcon="fa-solid fa-volume-low"
                elementName="distressbutton[volume]"
                min="0"
                max="100"
                step="10"
                :value="$userData['distressbutton']['volume'] ?? UserData::DEFAULT_DISTRESSBUTTON_VOLUME"
                unit="%"
            />


            <x-inputs.toggle
                elementTitleText="{{__('wizard/step6_2.togglemessage.label')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-paper-plane"
                elementDesc="{{__('wizard/step6_2.togglemessage.description')}}"
                elementId="distressbutton_message_active"
                elementName="distressbutton[message_active]"
                :value="$userData['distressbutton']['message_active'] ?? UserData::DEFAULT_DISTRESSBUTTON_MESSAGE"/>

            <x-inputs.textarea
                elementTitleText="{{__('wizard/step6_2.message_text.label')}}"
                elementTitleBook=""
                elementTitleSmall="true"
                elementAsLabel="true"
                elementIcon="fa-solid fa-envelope"
                elementDesc="{{__('wizard/step6_2.message_text.description')}}"
                elementId="distressbutton_message_text"
                elementName="distressbutton[message_text]"
                elementValue="{{ $userData['distressbutton']['message_text'] ?? UserData::DEFAULT_DISTRESSBUTTON_MESSAGE_TEXT }}">
            </x-inputs.textarea>

        </x-component-whitebox>
    </x-component-form>
@endsection


