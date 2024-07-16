@extends('layouts.backend')
@section('pagetitle')
    Meeting anlegen
@endsection

@section('content')
    <div class="mt-5">
        @if (session('success'))
            <x-component-messages :messages="session('success')" messageType="success"
                messageTitle="{{ __('backend/meeting.successTitle') }}" />
        @endif

        @if (session('errors'))
            <x-component-messages :messages="session('errors')" messageType="error" />
        @endif
    </div>

    @push('title')
        <h1>{{ __('backend/meeting.create.pageTitle') }}</h1>
    @endpush

    @include('lag::meeting.create-internal')
@endsection
@section('formcontrols')
    <button class="btn btn-primary component-button" onclick="document.getElementById('createMeetingForm').submit();">
        {{ __('backend/meeting.create.submit') }}
    </button>

    <a role="button" class="btn btn-light component-button"
        href="{{ route('lag.meeting.index') }}">{{ __('backend/meeting.create.cancel') }}
    </a>
@endsection
