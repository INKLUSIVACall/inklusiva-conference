@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection

@section('content')
    <x-component-progressbox wizardStep="5" wizardTotalSteps="{{ $numberOfSteps }}" title="{{ __('wizard/step1.progressbox.title') }}" />

    <x-wizard.component-steps
        active='translate'
        nextStep='summary'
        :meeting="$meeting"
        :role="$role"
    />

    <x-component-descbox
        ariaLabel="{{__('wizard/step7.descbox.ariaLabel')}}"
        format="{{__('wizard/step7.descbox.format')}}"
        title="{{__('wizard/step7.descbox.title')}}"
        desc="{{__('wizard/step7.descbox.desc')}}"
        helpLink="/assistent-fuer-barrierefreiheit/6-dolmetschen/"
    />

    <x-component-form id="stepForm" method="post" action="{{ route('lag.wizard.translatepost') }}" :role="$role" :meeting="$meeting">

        <x-component-whitebox
            title="{{__('wizard/step7_2.whitebox1.title')}}"
            format="{{__('wizard/step7_2.whitebox1.format')}}"
            id="assistant_signLang_settings"
            ariaLabel="{{__('wizard/step7_2.whitebox1.ariaLabel')}}">
                <x-inputs.radio
                    elementTitleText="{{__('wizard/step7_2.assistant_signLang.legend')}}"
                    elementTitleSmall="true"
                    elementAsLabel=""
                    elementAsLegend="true"
                    elementIcon="fa-solid fa-photo-film"
                    elementDesc="{{__('wizard/step7_2.assistant_signLang.desc')}}"
                    elementId="audio[output]"
                    elementName="assistant[signLang][display]"
                    radioRow="true"
                    :options="[
                        'window' => __('wizard/step7_2.assistant_signLang.option.window'),
                        'tile' => __('wizard/step7_2.assistant_signLang.option.tile'),
                    ]"
                    :selected="$userData['assistant']['signLang']['display'] ?? UserData::DEFAULT_ASSISTANT_SIGNLANG_DISPLAY"/>

                <x-inputs.slider
                    :elementTitleText="__('wizard/step7_2.assistant_signLang.windowSize.label')"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    :elementDesc="__('wizard/step7_2.assistant_signLang.windowSize.desc')"
                    elementAsLabel="true"
                    elementId="assistant_signLang_windowSize"
                    elementIcon="fa-solid fa-window-maximize"
                    elementName="assistant[signLang][windowSize]"
                    min="0"
                    max="100"
                    step="10"
                    :value="$userData['assistant']['signLang']['windowSize'] ?? UserData::DEFAULT_ASSISTANT_SIGNLANG_WINDOW_SIZE"
                    unit="%"
                />
        </x-component-whitebox>

        @php
            $transcriptionActive = false;
            if (isset($userData['assistant']['transcription'])) {
                $transcriptionActive = $userData['assistant']['transcription']['active'];
            } else {
                if (isset($userData['assistant']['signLang'])) {
                    $transcriptionActive = $userData['assistant']['signLang']['active'];
                } else {
                    $transcriptionActive = userData::DEFAULT_ASSISTANT_TRANSCRIPTION_ACTIVE;
                }
            }
        @endphp
    </x-component-form>
    <script type="text/javascript">
        function updateFontSize(value) {
            switch (value) {
                case '0':
                    var fontSize = '75%';
                    break;
                case '1':
                    var fontSize = '100%';
                    break;
                case '2':
                    var fontSize = '125%';
                    break;
                default:
                    var fontSize = '100%';
            }
            var text = document.getElementById('previewFontSize');
            text.style.fontSize = fontSize;
        }
        document.addEventListener("DOMContentLoaded", (event) => {
            updateFontSize('{{$userData['assistant']['transcription']['fontSize'] ?? UserData::DEFAULT_ASSISTANT_TRANSCRIPTION_FONT_SIZE}}');
        })
    </script>
@endsection


