@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection

@section('content')
<x-component-progressbox wizardStep="6" wizardTotalSteps="{{ $numberOfSteps }}" title="{{ __('wizard/step1.progressbox.title') }}" />
<x-wizard.component-steps active='captioning' nextStep='summary' :meeting="$meeting" :role="$role" />
<x-component-messages :messages=$errors />
<x-component-form id="stepForm" method="post" action="{{ route('lag.wizard.captioningpost') }}" :meeting="$meeting"
    :role="$role">
    <div class="component-descbox-list">
        <x-component-whitebox format="{{ __('wizard/captioning.whitebox.format') }}"
            title="{{ __('wizard/captioning.whitebox.title') }}" ariaLabel="{{ __('wizard/captioning.whitebox.ariaLabel') }}">
            <x-inputs.inputfield elementTitleText="{{ __('wizard/captioning.readlink.label') }}" elementTitleSmall="true"
                elementAsLabel="true" elementIcon="" elementDesc="{{ __('wizard/captioning.readlink.description') }}"
                elementId="transcriptionLink" elementName="transcriptionLink" elementPlaceholder="{{ __('wizard/captioning.readlink.placeholder') }}"
                :elementValue="old('transcriptionLink', $userData['transcriptionLink'] ?? '')">
            </x-inputs.inputfield>
        </x-component-whitebox>
    </div>
</x-component-form>
@endsection
