@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection


@section('content')
    <x-component-progressbox wizardStep="6" wizardTotalSteps="{{ $numberOfSteps }}" title="{{ __('wizard/step1.progressbox.title') }}" />

    @if($meeting !== null)
        <x-wizard.component-steps
            active='summary'
            nextStep='meeting'
            :meeting="$meeting"
            submitButtonLabel="Zum Meeting"
            :role="$role"
        />
    @else
        <x-wizard.component-steps
            active='summary'
            nextStep='meeting'
            submitButtonLabel="Einstellungen speichern"
            submitMessage="Einstellungen wurden erfolgreich gespeichert."
            :role="null"
        />
    @endif


    <x-component-messages :messages=$errors />
    <x-component-descbox
        ariaLabel="{{__('wizard/summary.descbox.ariaLabel')}}"
        desc="{{__('wizard/summary.descbox.desc')}}"
        format="{{__('wizard/summary.descbox.format')}}"
        helpLink="/assistent-fuer-barrierefreiheit/7-zusammenfassung/"
        title="{{__('wizard/summary.descbox.title')}}"
    />

    <x-component-whitebox
        format="{{__('wizard/summary.whitebox1.format')}}"
        title="{{__('wizard/summary.whitebox1.title')}}"
        ariaLabel="{{__('wizard/summary.whitebox1.ariaLabel')}}"
    >
        <x-component-datacollection
            id="user"
            headline="{{__('wizard/summary.user.headline')}}"
            :content="$content['user']"
        />

        <x-component-datacollection
            id="ui"
            headline="{{__('wizard/summary.ui.headline')}}"
            :content="$content['ui']"
        />

        <x-component-datacollection
            id="video"
            headline="{{__('wizard/summary.video.headline')}}"
            :content="$content['video']"
        />

        <x-component-datacollection
            id="audio"
            headline="{{__('wizard/summary.audio.headline')}}"
            :content="$content['audio']"
        />

        <x-component-datacollection
            id="distressbutton"
            headline="{{__('wizard/summary.distressbutton.headline')}}"
            :content="$content['distressbutton']"
        />

        @if (isset($content['assistants']))
            <x-component-datacollection
                id="assistants"
                headline="{{__('wizard/summary.assistants.headline')}}"
                :content="$content['assistants']"
            />
        @endif
        @if($role === 'captioner')
        <x-component-datacollection
            id="captioning"
            headline="{{__('wizard/summary.captioning.headline')}}"
            :content="$content['captioning']"
        />
        @endif

    </x-component-whitebox>

    <x-component-whitebox
        ariaLabel="{{__('wizard/summary.whitebox2.ariaLabel')}}"
        format="{{__('wizard/summary.whitebox2.format')}}"
        title="{{__('wizard/summary.whitebox2.title')}}"
    >

        <x-component-form
            id="stepForm" method="post" action="{{ route('lag.wizard.summarypost') }}"
            :role="$role"
            :meeting="$meeting">
            @if($meeting !== null)
            <x-inputs.toggle
                elementTitleText="{{__('wizard/summary.saveSettings.label')}}"
                elementTitleSmall=""
                elementTitleBook=""
                elementAsLabel=""
                elementIcon=""
                elementDesc="{{__('wizard/summary.saveSettings.description')}}"
                elementId="saveSettings"
                elementName="saveSettings"
                :value="$userData['saveSettings'] ?? false"/>
            @endif

            <x-component-title-and-description
                elementTitleText="{{__('wizard/summary.download.title')}}"
                elementTitleSmall="true"
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-floppy-disk"
                elementDesc="{{__('wizard/summary.download.desc')}}"
                elementId="userdataDownloadLink"
            >
                <x-component-textlink
                    linkName="{{__('wizard/summary.download.linktitle')}}"
                    linkHref="#"
                    linkId="userdataDownloadLink"
                />
            </x-component-title-and-description>

        </x-component-form>

    </x-component-whitebox>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initSummary(@json($userData));
        });
    </script>
    @push('scripts')
        @vite('resources/js/views/wizard/summary.js')
    @endpush
@endsection


