@extends('layouts.backend')
@section('pagetitle')
    {{ __('backend/meeting.detail.pageTitle') }}
@endsection

@section('content')
    @if (session('success'))
        <x-component-messages :messages="session('success')" messageType="success"
            messageTitle="{{ __('backend/meeting.successTitle') }}" />
    @endif

    @if (session('errors'))
        <x-component-messages :messages="session('errors')" messageType="error" />
    @endif

@section('formcontrols')
    <a role="button" class="btn btn-primary component-button"
        href="{{ route('lag.meeting.index') }}">{{ __('backend/meeting.detail.close') }}
    </a>
@endsection

@push('pagetitle')
    <h1>{{ __('backend/meeting.detail.pageTitle') }}</h1>
@endpush

@include('lag::meeting.detail-internal')
@endsection
