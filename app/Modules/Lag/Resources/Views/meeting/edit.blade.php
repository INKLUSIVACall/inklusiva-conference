@extends('layouts.backend')
@section('pagetitle')
    Meeting ändern
@endsection

@section('content')
    @if (session('success'))
        <x-component-messages :messages="session('success')" messageType="success"
            messageTitle="{{ __('backend/meeting.successTitle') }}" />
    @endif

    @if (session('errors'))
        <x-component-messages :messages="session('errors')" messageType="error" />
    @endif

    @push('title')
        <h1>Meeting ändern</h1>
    @endpush

    @include('lag::meeting.edit-internal')
@endsection
@section('formcontrols')
    <button class="btn btn-primary component-button" onclick="document.getElementById('updateMeetingForm').submit();">
        Meeting speichern
    </button>
    <a class="btn btn-light component-button" href="{{ route('lag.meeting.index') }}">abbrechen </a>
@endsection
