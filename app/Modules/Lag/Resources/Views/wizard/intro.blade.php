@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection

@section('content')
    {{-- <div class="mt-5"> --}}
    {{--     <x-component-messages :messages=$errors /> --}}
    {{-- </div> --}}
    <x-component-form id="stepForm" method="post" action="{{ route('lag.wizard.intropost') }}" :meeting="$meeting"
        :role="$role" enctype="multipart/form-data">
        <div class="component-descbox-list">
            @if ($meeting !== null)
                <x-component-descbox showError="true"
                    title="{{ __('wizard/intro.descbox.headline', ['meetingname' => $meeting->name_display]) }}"
                    format="{{ __('wizard/intro.descbox.format') }}" ariaLabel="{{ __('wizard/intro.descbox.ariaLabel') }}"
                    desc="{{ __('wizard/intro.descbox.desc') }}" border="true"
                    helpLink="/assistent-fuer-barrierefreiheit/1-einstiegs-seite/" />
            @endif

            @if ($meeting !== null)
                <x-component-descbox border="true" ariaLabel="{{ __('wizard/intro.section0.ariaLabel') }}"
                    title="{{ __('wizard/intro.section0.title') }}" format="{{ __('wizard/intro.section0.format') }}"
                    desc="{{ __('wizard/intro.section0.desc') }}" />
            @else
                <x-component-descbox border="true" ariaLabel="{{ __('wizard/intro.section0.ariaLabel') }}"
                    title="{{ __('wizard/intro.section0.title') }}" format="{{ __('wizard/intro.section0.format') }}"
                    desc="{{ __('wizard/intro.section0.desc') }}"
                    helpLink="/assistent-fuer-barrierefreiheit/1-einstiegs-seite/" />
            @endif


            <x-component-descbox border="true" ariaLabel="{{ __('wizard/intro.section1.ariaLabel') }}"
                title="{{ __('wizard/intro.section1.title') }}" format="{{ __('wizard/intro.section1.format') }}"
                desc="{{ __('wizard/intro.section1.desc') }}" />

            @if ($meeting !== null && $meeting->should_record)
                <x-component-descbox border="true" ariaLabel="{{ __('wizard/intro.section2.ariaLabel') }}"
                    title="{{ __('wizard/intro.section2.title') }}" format="{{ __('wizard/intro.section2.format') }}"
                    desc="{{ __('wizard/intro.section2.desc') }}">
                    <x-inputs.toggle-simple elementLabel="{{ __('wizard/intro.recordingConsent.label') }}"
                        elementId="recordingConsent" elementName="recordingConsent" :value="old('recordingConsent') ?? false" />
                </x-component-descbox>
            @endif
            <x-component-descbox ariaLabel="{{ __('wizard/intro.section3.ariaLabel') }}"
                title="{{ __('wizard/intro.section3.title') }}" format="{{ __('wizard/intro.section3.format') }}"
                desc="{{ __('wizard/intro.section3.desc') }}">
                <x-inputs.toggle-simple elementLabel="{{ __('wizard/intro.privacyConsent.label') }}"
                    elementId="datenschutz" elementName="datenschutz" :value="old('datenschutz') ?? false" />
            </x-component-descbox>
            <x-component-whitebox :title="__('wizard/step1.whitebox.title')" :format="__('wizard/step1.whitebox.format')" :ariaLabel="__('wizard/step1.whitebox.ariaLabel')">
                <x-inputs.radio :elementTitleText="__('wizard/step1.radio.legend')" elementTitleSmall="" elementAsLabel="" elementAsLegend="true"
                    elementIcon="" :elementDesc="__('wizard/step1.radio.desc')" elementId="mode" elementName="mode" noMarginBottom="true"
                    onChange="changeMeetingSettings(event)" :options="[
                        'base' => __('wizard/step1.radio.options.base'),
                        'individual' => __('wizard/step1.radio.options.individual'),
                        'upload' => __('wizard/step1.radio.options.upload'),
                    ]" :selected="old('mode') ?? 'base'" />

                <x-inputs.file elementTitleText="{{ __('wizard/step1.file.upload.label') }}" elementTitleSmall="true"
                    elementAsLabel="true" elementAsLegend="" elementIcon="fa-solid fa-upload"
                    elementDesc="{{ __('wizard/step1.file.upload.desc') }}" elementId="upload" elementName="upload"
                    accept=".json" :hidden=true />
            </x-component-whitebox>
        </div>
    </x-component-form>
    <script>
        const changeMeetingSettings = (event) => {
            if (event.target.value === 'upload') {
                document.getElementById('component_upload').removeAttribute('hidden')
            } else {
                document.getElementById('component_upload').setAttribute('hidden', '')
            }
            updateButtonDesc(event.target.value);
        }

        const updateButtonDesc = (value) => {
            const buttonDesc = (value === 'individual') ?
                '{{ __('wizard/intro.formcontrols.submit.start') }}' : 'Weiter';
            document.getElementById('nextButton').value = buttonDesc;
        };

        window.addEventListener('DOMContentLoaded', () => {
            updateButtonDesc(document.querySelector('[name=mode]:checked'))
        });
    </script>
@endsection

@section('formcontrols')
    <input type="button" class="btn btn-primary component-button" aria-describedby="buttondesc" id="nextButton"
        onclick="submitStepForm('about')" value="{{ __('wizard/intro.formcontrols.submit.start') }}" />
    <span aria-hidden="true" style="display: none"
        id="buttondesc">{{ __('wizard/intro.formcontrols.submit.start') }}</span>
@endsection

@push('scripts')
    <script>
        /**
         * Adds a hidden field for the next step to the form and submits it.
         *
         * @param {string} target - The target step, should be one of the following: intro, visual, audio, distress, translate, summary
         */
        function submitStepForm(target, meetingId = null) {
            if (target !== 'meeting') {
                var form = document.getElementById("stepForm");
                // add a hidden field for the target step
                var targetInput = document.createElement("input");
                targetInput.setAttribute("type", "hidden");
                targetInput.setAttribute("name", "targetStep");
                targetInput.setAttribute("value", target);
                form.appendChild(targetInput);
                form.submit();
            } else {
                if (meetingId != null) {
                    window.location.href = "{{ route('lag.wizard.summarypost', ['meetingId' => ' + meetingId + ']) }}";
                } else {
                    window.location.href = "{{ route('lag.wizard.summarypost') }}";
                }
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            let userData = localStorage.getItem("userData");

            if (userData) {
                userData = JSON.parse(userData);
                // paste userData into form
                console.log(userData);
                let form = document.getElementById("stepForm");
                let input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "userData");
                input.setAttribute("value", JSON.stringify(userData));
                form.appendChild(input);
            }

            // Entscheide ob component_upload angezeigt werden soll, basierend darauf, ob modeUpload ausgewählt ist
            let modeUpload = document.getElementById("mode_upload");
            let upload = document.getElementById("component_upload");

            if (modeUpload.checked) {
                upload.removeAttribute("hidden");
            }
        });

        let modeUpload = document.getElementById("mode_upload");
        let upload = document.getElementById("component_upload");
        let upload_label = document.getElementById("upload_label");
        if (modeUpload.checked) {
            upload.removeAttribute("hidden");
        }
        modeUpload.addEventListener("click", function() {
            upload.removeAttribute("hidden");
        });
        let modeIndividual = document.getElementById("mode_individual");
        modeIndividual.addEventListener("click", function() {
            upload.setAttribute("hidden", "");
        });
        let modeBase = document.getElementById("mode_base");
        modeBase.addEventListener("click", function() {
            upload.setAttribute("hidden", "");
        });
    </script>
@endpush
