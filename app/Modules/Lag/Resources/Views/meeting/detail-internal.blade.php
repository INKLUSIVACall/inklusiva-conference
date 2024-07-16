<x-component-whitebox title="{{ __('backend/meeting.detail.pageTitle') }}" class="meeting-details">
    <h2 class="meeting-details-title">{{ __('backend/meeting.detail.title.summary') }}</h2>
    <ul class="meeting-details-summary">
        <li>
            <i class="fas fa-xl fa-video"></i>
            <p>{{ $meeting->name_display }}</p>
        </li>
        <li>
            <i class="fas fa-xl fa-clock"></i>
            <p>{{ $meeting->getStartDateFormatted() }}</p>
        </li>
        <li>
            @if ($meeting->should_record)
                <i class="fas fa-xl fa-record-vinyl"></i>
                <p>
                    {{ __('backend/meeting.detail.recording.on') }}
                </p>
            @else
                <i class="fas fa-xl fa-video-slash"></i>
                <p>
                    {{ __('backend/meeting.detail.recording.off') }}
                </p>
            @endif
            </p>
        </li>
        <li>
            <i class="fas fa-xl fa-sign-language"></i>
            <p>
                @if ($meeting->sign_language_interpreter)
                    {{ __('backend/meeting.detail.signLang.on') }}
                @else
                    {{ __('backend/meeting.detail.signLang.off') }}
                @endif
            </p>
        </li>
        <li>
            <i class="fas fa-xl fa-message"></i>
            <p>
                @if ($meeting->text_interpreter)
                    {{ __('backend/meeting.detail.textInterpreter.on') }}
                @else
                    {{ __('backend/meeting.detail.textInterpreter.off') }}
                @endif
            </p>
        </li>
    </ul>
</x-component-whitebox>

<x-component-whitebox title="{{ __('backend/meeting.detail.links.title') }}" class="meeting-details">
    <div class="meeting-link-block">
        <h2 class="meeting-details-title"> <i class="fas fa-star"></i>{{ __('backend/meeting.detail.links.text') }}
        </h2>
        {!! __('backend/meeting.detail.links.desc') !!}

        <x-meeting-links-row link="{{ route('lag.wizard.intro', ['id' => $meeting->getMeetingUUIDModerator()]) }}"
            mailLink="{{ route('lag.meeting.mailtemplate', ['meeting' => $meeting, 'role' => 'moderator', 'link' => $meeting->getMeetingUUIDModerator()]) }}" />
    </div>

    <div class="meeting-link-block">
        <h2 class="meeting-details-title"><i
                class="fas fa-star-half-stroke"></i>{{ __('backend/meeting.detail.links.comoderator.text') }}</h2>
        {!! __('backend/meeting.detail.links.comoderator.desc') !!}

        <x-meeting-links-row link="{{ route('lag.wizard.intro', ['id' => $meeting->getMeetingUUIDCoModerator()]) }}"
            mailLink="{{ route('lag.meeting.mailtemplate', ['meeting' => $meeting, 'role' => 'comoderator', 'link' => $meeting->getMeetingUUIDCoModerator()]) }}" />
    </div>

    <div class="meeting-link-block">
        <h2 class="meeting-details-title"><i
                class="fa fa-users"></i>{{ __('backend/meeting.detail.links.participant.text') }}</h2>
        {!! __('backend/meeting.detail.links.participant.desc') !!}
        <x-meeting-links-row link="{{ route('lag.wizard.intro', ['id' => $meeting->getMeetingUUIDParticipant()]) }}"
            mailLink="{{ route('lag.meeting.mailtemplate', ['meeting' => $meeting, 'role' => 'participant', 'link' => $meeting->getMeetingUUIDParticipant()]) }}" />
    </div>

    @if ($meeting->sign_language_interpreter)
        <div class="meeting-link-block">
            <h2 class="meeting-details-title"><i
                    class="fas fa-sign-language"></i>{{ __('backend/meeting.detail.links.assistentSignLang.text') }}
            </h2>
            {!! __('backend/meeting.detail.links.assistentSignLang.desc') !!}
            <x-meeting-links-row
                link="{{ route('lag.wizard.intro', ['id' => $meeting->getMeetingUUIDSignLangTranslator()]) }}"
                mailLink="{{ route('lag.meeting.mailtemplate', ['meeting' => $meeting, 'role' => 'signlangtranslator', 'link' => $meeting->getMeetingUUIDSignLangTranslator()]) }}" />
        </div>
    @endif
    @if ($meeting->text_interpreter)
        <div class="meeting-link-block">
            <h2 class="meeting-details-title"><i
                    class="fa fa-message"></i>{{ __('backend/meeting.detail.links.assistentCaptioner.text') }}</h2>
            {!! __('backend/meeting.detail.links.assistentCaptioner.desc') !!}
            <x-meeting-links-row link="{{ route('lag.wizard.intro', ['id' => $meeting->getMeetingUUIDCaptioner()]) }}"
                mailLink="{{ route('lag.meeting.mailtemplate', ['meeting' => $meeting, 'role' => 'captioner', 'link' => $meeting->getMeetingUUIDCaptioner()]) }}" />
        </div>
    @endif
</x-component-whitebox>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
            tooltipTriggerEl))
    });
</script>
