@extends('layouts.wizard')
@section('pagetitle')
    Teilnahme am Meeting
@endsection
@section('headline')
    @include('layouts.wizard.header', ['meeting' => $meeting])
@endsection

@section('content')
    <x-component-progressbox wizardStep="2" wizardTotalSteps="{{ $numberOfSteps }}" title="{{ __('wizard/step1.progressbox.title') }}" />

    <x-wizard.component-steps
        active='visual'
        nextStep='audio'
        :meeting="$meeting"
        :role="$role"
    />

    <x-component-descbox
        ariaLabel="{{__('wizard/step4.descbox.ariaLabel')}}"
        title="{{__('wizard/step4.descbox.title')}}"
        format="{{__('wizard/step4.descbox.format')}}"
        desc="{{__('wizard/step4.descbox.desc')}}"
        helpLink="/assistent-fuer-barrierefreiheit/3-sehen/"
    />

    <x-component-form
        id="stepForm"
        method="post"
        action="{{ route('lag.wizard.visualpost') }}"
        :meeting="$meeting"
        :role="$role"
    >

        <x-component-whitebox
            format="{{__('wizard/step4.whitebox1.format')}}"
            title="{{__('wizard/step4.whitebox1.title')}}"
            ariaLabel="{{__('wizard/step4.whitebox1.ariaLabel')}}"
        >

            <x-inputs.toggle
                elementTitleText="{{__('wizard/step4.ui.visualCues.label')}}"
                elementTitleSmall=""
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-eye"
                elementDesc="{{__('wizard/step4.ui.visualCues.description')}}"
                elementId="ui_visualCues"
                elementName="ui[visualCues]"
                :value="$userData['ui']['visualCues'] ?? UserData::DEFAULT_UI_VISUAL_CUES"/>

                <x-inputs.slider
                    elementTitleText="{{__('wizard/step4.ui.fontSize.label')}}"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    elementAsLabel="true"
                    elementId="ui_fontSize"
                    elementIcon="fa-solid fa-text-height"
                    elementName="ui[fontSize]"
                    oninput="updateFontSize(this.value)"
                    :value="$userData['ui']['fontSize'] ?? UserData::DEFAULT_UI_FONT_SIZE"
                    :possibleValues="UserData::POSSIBLE_VALUES_UI_FONT_SIZE"
                >

                <x-component-preview
                    previewType="text"
                    value="{{$userData['ui']['fontSize'] ?? UserData::DEFAULT_UI_FONT_SIZE}}" />

                </x-inputs.slider>
                <x-inputs.slider
                    elementTitleText="{{__('wizard/step4.ui.iconSize.label')}}"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    elementAsLabel="true"
                    elementId="ui_iconSize"
                    elementIcon="fa-solid fa-up-down"
                    elementName="ui[iconSize]"
                    oninput="updateIconSize(this.value)"
                    :value="$userData['ui']['iconSize'] ?? UserData::DEFAULT_UI_ICON_SIZE"
                    :possibleValues="UserData::POSSIBLE_VALUES_UI_ICON_SIZE"
                >
                <x-component-preview
                    previewType="icon"
                    value="{{$userData['ui']['iconSize'] ?? UserData::DEFAULT_UI_ICON_SIZE}}" />

                </x-inputs.slider>

        </x-component-whitebox>


        <x-component-whitebox
            format="{{__('wizard/step4.whitebox2.format')}}"
            title="{{__('wizard/step4.whitebox2.title')}}"
            ariaLabel="{{__('wizard/step4.whitebox2.ariaLabel')}}"
        >
            <x-inputs.toggle
                elementTitleText="{{__('wizard/step4.video_otherParticipants.label')}}"
                elementTitleSmall=""
                elementTitleBook=""
                elementAsLabel=""
                elementIcon="fa-solid fa-users-between-lines"
                elementDesc="{{__('wizard/step4.video_otherParticipants.description')}}"
                elementId="video_otherParticipants"
                elementName="video[otherParticipants]"
                :value="$userData['video']['otherParticipants'] ?? UserData::DEFAULT_VIDEO_OTHER_PARTICIPANTS"/>

                <x-inputs.slider
                    elementTitleText="{{__('wizard/step4.contrast.label')}}"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    elementAsLabel="true"
                    elementIcon="fa-solid fa-circle-half-stroke"
                    elementDesc=""
                    elementId="video_contrast"
                    elementName="video[contrast]"
                    min="0"
                    max="100"
                    step="10"
                    :value="$userData['video']['contrast'] ?? UserData::DEFAULT_VIDEO_CONTRAST"
                    unit="%"
                />

                <x-inputs.slider
                    elementTitleText="{{__('wizard/step4.brightness.label')}}"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    elementAsLabel="true"
                    elementIcon="fa-solid fa-bolt-lightning"
                    elementDesc=""
                    elementId="video_brightness"
                    elementName="video[brightness]"
                    min="50"
                    max="150"
                    step="10"
                    :value="$userData['video']['brightness'] ?? UserData::DEFAULT_VIDEO_BRIGHTNESS"
                    unit="%"
                />

                <x-inputs.slider
                    elementTitleText="{{__('wizard/step4.dimming.label')}}"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    elementAsLabel="true"
                    elementIcon="fa-solid fa-sun"
                    elementDesc=""
                    elementId="video_dimming"
                    elementName="video[dimming]"
                    min="0"
                    max="100"
                    step="10"
                    :value="$userData['video']['dimming'] ?? UserData::DEFAULT_VIDEO_DIMMING"
                    unit="%"
                />
                <x-inputs.slider
                    elementTitleText="{{__('wizard/step4.saturation.label')}}"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    elementAsLabel="true"
                    elementIcon="fa-solid fa-droplet"
                    elementDesc=""
                    elementId="video_saturation"
                    elementName="video[saturation]"
                    min="0"
                    max="100"
                    step="10"
                    :value="$userData['video']['saturation'] ?? UserData::DEFAULT_VIDEO_SATURATION"
                    unit="%"
                />
                <x-inputs.slider
                    elementTitleText="{{__('wizard/step4.zoom.label')}}"
                    elementTitleSmall="true"
                    elementTitleBook=""
                    elementAsLabel="true"
                    elementIcon="fa-solid fa-magnifying-glass"
                    elementDesc=""
                    elementId="video_zoom"
                    elementName="video[zoom]"
                    min="0"
                    max="200"
                    step="10"
                    :value="$userData['video']['zoom'] ?? UserData::DEFAULT_VIDEO_ZOOM"
                    unit="%"
                />
        </x-component-whitebox>
    </x-component-form>
@endsection


