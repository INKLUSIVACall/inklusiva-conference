<form id="updateMeetingForm" method="POST" action="{{ route('lag.meeting.update', ['meeting' => $meeting]) }}">
    @csrf
    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.titleAndDate.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.titleAndDate.legend') }}">
        <x-inputs.inputfield elementTitleText="{{ __('backend/meeting.create.titleAndDate.title.titleText') }}"
            elementDesc="{{ __('backend/meeting.create.titleAndDate.title.desc') }}" elementId="name" elementName="name"
            elementValue="{{ old('name', $meeting->name_display) }}"
            elementPlaceholder="{{ __('backend/meeting.create.titleAndDate.title.placeholder') }}"
            elementRequired="true" elementAutofocus="true" />

        @if ($meeting->start !== null)
            <x-wizard.component-element icon=""
                headline="{{ __('backend/meeting.create.titleAndDate.date.headline') }}"
                description="{{ __('backend/meeting.create.titleAndDate.date.desc') }}">

                <x-inputs.datetime label="" id="start"
                    name="start" value_date="{{ old('start', date('Y-m-d', strtotime($meeting->start))) }}"
                    value_time="{{ old('start', date('H:i', strtotime($meeting->start))) }}" required />
            </x-wizard.component-element>
            <input type="hidden" name="meetingtype" value="planned">
        @else
            <input type="hidden" name="meetingtype" value="persistent">
        @endif

    </x-component-whitebox>

    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.recording.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.recording.legend') }}">
        <x-inputs.toggle elementTitleText="{{ __('backend/meeting.create.recording.titleText') }}"
            elementDesc="{{ __('backend/meeting.create.recording.desc') }}" elementId="should_record"
            elementName="should_record" :value="old('should_record', $meeting->should_record)" />
    </x-component-whitebox>

    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.signLang.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.signLang.legend') }}">
        <x-inputs.toggle elementTitleText="{{ __('backend/meeting.create.signLang.titleText') }}"
            elementDesc="{{ __('backend/meeting.create.signLang.desc') }}" elementId="sign_language_interpreter"
            elementName="sign_language_interpreter" :value="old('sign_language_interpreter', $meeting->sign_language_interpreter)" />
    </x-component-whitebox>

    <x-component-whitebox sectionAriaLabel="{{ __('backend/meeting.create.textInterpreter.ariaLabel') }}"
        legend="{{ __('backend/meeting.create.textInterpreter.legend') }}">
        <x-inputs.toggle elementDesc="{{ __('backend/meeting.create.textInterpreter.desc') }}"
            elementTitleText="{{ __('backend/meeting.create.textInterpreter.titleText') }}"
            elementId="text_interpreter" elementName="text_interpreter" :value="old('text_interpreter', $meeting->text_interpreter)" />
    </x-component-whitebox>
</form>
