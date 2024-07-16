<x-component-descbox title="{{ __('backend/meeting.create.pageTitle') }}"
    format="{{ __('backend/meeting.create.pageFormat') }}" desc="{{ __('backend/meeting.create.pageDesc') }}"
    helpLink="{{ __('backend/meeting.create.pageHelpLink') }}" />

<x-component-form id="createMeetingForm" method="POST" action="{{ route('lag.meeting.store') }}" :meeting="null">

    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.titleAndDate.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.titleAndDate.legend') }}">
        <x-inputs.inputfield elementTitleText="{{ __('backend/meeting.create.titleAndDate.title.titleText') }}"
            elementDesc="{{ __('backend/meeting.create.titleAndDate.title.desc') }}" elementId="name" elementName="name"
            elementValue="{{ old('name') }}"
            elementPlaceholder="{{ __('backend/meeting.create.titleAndDate.title.placeholder') }}"
            elementRequired="true" elementAutofocus="true"
            elementAsLabel="true" />

        <x-inputs.radio elementTitleText="" elementTitleSmall="true" elementAsLabel="" elementAsLegend="true"
            elementIcon="" noMarginBottom="true"
            elementDesc="{{ __('backend/personaldata.edit.input.occupationDesc') }}" onChange="toggleMeetingType(this)"
            elementId="meetingtype" elementName="meetingtype" radioRow="true" :options="[
                'planned' => 'Geplantes Meeting',
                'persistent' => 'Dauerhaftes Meeting',
            ]" :selected="old('occupation')" />

        <script>
            function toggleMeetingType(element) {
                if (element.value == 'planned') {
                    document.getElementById('plannedMeeting').style.display = 'block';
                } else {
                    document.getElementById('plannedMeeting').style.display = 'none';
                }
            }
        </script>

        <div id="plannedMeeting" style="display: block;">
            <x-wizard.component-element icon=""
                headline="{{ __('backend/meeting.create.titleAndDate.date.headline') }}"
                description="{{ __('backend/meeting.create.titleAndDate.date.desc') }}">
                <x-inputs.datetime label="start_date" id="start" name="start" value_date="{{ old('start_date') }}" value_time="{{old('start_time')}}" required />
            </x-wizard.component-element>
        </div>
    </x-component-whitebox>

    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.recording.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.recording.legend') }}">
        <x-inputs.toggle elementTitleText="{{ __('backend/meeting.create.recording.titleText') }}"
            elementDesc="{{ __('backend/meeting.create.recording.desc') }}" elementId="should_record"
            elementName="should_record" :value="old('should_record') ?? false" />
    </x-component-whitebox>

    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.signLang.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.signLang.legend') }}">
        <x-inputs.toggle elementTitleText="{{ __('backend/meeting.create.signLang.titleText') }}"
            elementDesc="{{ __('backend/meeting.create.signLang.desc') }}" elementId="sign_language_interpreter"
            elementName="sign_language_interpreter" :value="old('sign_language_interpreter') ?? false" />
    </x-component-whitebox>

    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.textInterpreter.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.textInterpreter.legend') }}">
        <x-inputs.toggle elementDesc="{{ __('backend/meeting.create.textInterpreter.desc') }}"
            elementTitleText="{{ __('backend/meeting.create.textInterpreter.titleText') }}"
            elementId="text_interpreter" elementName="text_interpreter" :value="old('text_interpreter') ?? false" />
    </x-component-whitebox>

</x-component-form>
