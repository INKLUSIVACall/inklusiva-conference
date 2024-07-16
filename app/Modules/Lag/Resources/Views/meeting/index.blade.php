@extends('layouts.backend')
@section('pagetitle')
    geplante Meetings
@endsection


@section('content')
    <div class="mt-3">
        @if(session('success'))
            <x-component-messages
                :messages="session('success')"
                messageType="success"
                messageTitle="{{ __('backend/meeting.successTitle') }}"/>
            @endif

            @if(session('errors'))
                <x-component-messages
                    :messages="session('errors')"
                    messageType="error"/>
            @endif
    </div>

    <x-component-descbox
        title="{{__('backend/meeting.index.title')}}"
        format="h1"
        desc="{{__('backend/meeting.index.desc')}}"
        helpLink="/backend/meetings/"
        border="true"
        borderDotted="true"
    />

    <div class="container">
        @include('lag::meeting.index-internal')
    </div>
@endsection
