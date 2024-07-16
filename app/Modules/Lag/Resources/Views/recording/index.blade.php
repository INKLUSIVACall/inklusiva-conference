@extends('layouts.backend')
@section('pagetitle')
    Aufzeichnungen
@endsection
@section('content')
    @if (session('success'))
        <x-component-messages :messages="session('success')" messageType="success"
            messageTitle="{{ __('backend/meeting.successTitle') }}" />
    @endif

    @if (session('errors'))
        <x-component-messages :messages="session('errors')" messageType="error" />
    @endif

    <x-component-descbox title="{{ __('backend/recording.index.title') }}" format="h1"
        desc="{{ __('backend/recording.index.desc') }}" border="true" borderDotted="true" />

    @push('title')
        <h1>{{ __('backend/recording.index.title') }}</h1>
    @endpush

    @include('lag::recording.index-internal')
@endsection
