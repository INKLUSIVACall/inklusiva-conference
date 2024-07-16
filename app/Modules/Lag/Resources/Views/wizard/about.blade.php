@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection

@section('content')
    @if ($mode !== 'base')
        <x-component-progressbox wizardStep="1" wizardTotalSteps="{{ $numberOfSteps }}"
            title="{{ __('wizard/step1.progressbox.title') }}" />
        <x-wizard.component-steps active='about' nextStep='visual' :meeting="$meeting" :role="$role" />
        <x-component-messages :messages=$errors />
        @if (session('success'))
            <x-component-messages :messages="session('success')[0]" messageType="success"
                messageTitle="{{ __('backend/user.index.successTitle') }}" />
        @endif
        <x-component-form id="stepForm" method="post" action="{{ route('lag.wizard.aboutpost') }}" :meeting="$meeting"
            :role="$role">

            <div class="component-descbox-list">
                <div class="container" >
                    <div class="help-item" style="display: flex; justify-content: flex-end">
                        <x-component-help-button helpLink="/assistent-fuer-barrierefreiheit/2-basis/" title="Hilfe öffnen" />
                    </div>
                </div>
                <x-component-whitebox format="{{ __('wizard/step2.whitebox.format') }}"
                    title="{{ __('wizard/step2.whitebox.title') }}" ariaLabel="{{ __('wizard/step2.whitebox.ariaLabel') }}">

                    <x-inputs.inputfield elementTitleText="{{ __('wizard/step2.name.label') }}" elementTitleSmall="true"
                        elementAsLabel="true" elementIcon="" elementDesc="{{ __('wizard/step2.name.description') }}"
                        elementId="username" elementName="name"
                        elementPlaceholder="{{ __('wizard/step2.name.placeholder') }}" :elementValue="old('name', $userData['name'] ?? '')">
                    </x-inputs.inputfield>
                </x-component-whitebox>
                <x-component-whitebox title="{{ __('wizard/step3.whitebox4.title') }}"
                    format="{{ __('wizard/step3.whitebox4.format') }}"
                    ariaLabel="{{ __('wizard/step3.whitebox4.ariaLabel') }}">

                    <x-inputs.toggle elementTitleText="{{ __('wizard/step3.signLang.label') }}" elementTitleSmall=""
                        elementTitleBook="" elementAsLabel="" elementIcon=""
                        elementDesc="{{ __('wizard/step3.signLang.inputDescription') }}" elementId="assistant_signLang"
                        elementName="assistant[signLang][active]" :value="$userData['assistant']['signLang']['active'] ??
                            UserData::DEFAULT_ASSISTANT_SIGNLANG_ACTIVE" />
                </x-component-whitebox>
                <x-component-whitebox format="{{ __('wizard/step3.whitebox6.format') }}"
                    title="{{ __('wizard/step3.whitebox6.title') }}"
                    ariaLabel="{{ __('wizard/step3.whitebox6.ariaLabel') }}">

                    <x-inputs.toggle elementTitleText="{{ __('wizard/step3.dyslex.label') }}" elementTitleSmall=""
                        elementTitleBook="" elementAsLabel="" elementIcon=""
                        elementDesc="{{ __('wizard/step3.dyslex.inputDescription') }}"
                        elementId="learning_difficulties_dyslexia" elementName="support[learning_difficulties]"
                        onChange="if (event.target.checked) {window.location.href = '{{ route('switchLanguage', ['language' => '']) }}/de-ES'} else {window.location.href = '{{ route('switchLanguage', ['language' => '']) }}/de-DE'}"
                        :value="session('language', 'de-DE') == 'de-ES'
                            ? true
                            : $userData['support']['learning_difficulties'] ??
                                UserData::DEFAULT_SUPPORT_LEARNING_DIFFICULTIES" />
                </x-component-whitebox>
            </div>
        </x-component-form>
    @else
        <x-component-progressbox wizardStep="1" wizardTotalSteps="2" title="Meeting direkt starten" />
        <x-component-messages :messages=$errors />
        <x-component-form id="stepForm" method="post" action="{{ route('lag.wizard.summarypost') }}" :meeting="$meeting"
            :role="$role">
            <div class="component-descbox-list">
                <x-component-whitebox format="{{ __('wizard/step2.whitebox.format') }}"
                    title="{{ __('wizard/step2.whitebox.title') }}"
                    ariaLabel="{{ __('wizard/step2.whitebox.ariaLabel') }}">
                    <x-inputs.inputfield elementTitleText="{{ __('wizard/step2.name.label') }}" elementTitleSmall="true"
                        elementAsLabel="true" elementIcon="" elementDesc="{{ __('wizard/step2.name.description') }}"
                        elementId="username" elementName="name" elementRequired="true"
                        elementPlaceholder="{{ __('wizard/step2.name.placeholder') }}" :elementValue="old('name', $userData['name'] ?? '')">

                        @if ($role !== 'captioner')
                            <div class="text-end mt-5">
                                <input type="hidden" name="targetStep" value="meeting">
                                <button class="btn btn-primary component-button">
                                    <i class="fas fa-xs"></i>
                                    {{ __('wizard/summary.joinMeetingButton') }}
                                </button>
                            </div>
                        @endif

                    </x-inputs.inputfield>
                    @if ($role === 'captioner')
                        <x-inputs.inputfield elementTitleText="{{ __('wizard/captioning.readlink.label') }}"
                            elementTitleSmall="true" elementAsLabel="true" elementIcon=""
                            elementDesc="{{ __('wizard/captioning.readlink.description') }}" elementId="transcriptionLink"
                            elementName="transcriptionLink"
                            elementPlaceholder="{{ __('wizard/captioning.readlink.placeholder') }}" :elementValue="old('transcriptionLink', $userData['transcriptionLink'] ?? '')">
                        </x-inputs.inputfield>
                        <div class="text-end mt-5">
                            <input type="hidden" name="targetStep" value="meeting">
                            <button class="btn btn-primary component-button">
                                <i class="fas fa-xs"></i>
                                {{ __('wizard/summary.joinMeetingButton') }}
                            </button>
                        </div>
                    @endif
                </x-component-whitebox>
            </div>

        </x-component-form>
    @endif
@endsection
