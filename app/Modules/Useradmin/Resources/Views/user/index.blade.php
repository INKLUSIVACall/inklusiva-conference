@extends('layouts.backend')
@section('pagetitle')
    {{ env('APP_NAME') }} - {{ __('backend/user.index.pagetitle') }}
@endsection
@section('content')

    @if (session('success'))
        <x-component-messages :messages="session('success')" messageType="success"
            messageTitle="{{ __('backend/user.index.successTitle') }}" />
    @endif

    @if (session('errors'))
        <x-component-messages :messages="session('errors')" messageType="error" />
    @endif

@section('formcontrols')
    <a role="button" href="{{ route('useradmin.user.create') }}"
        class="btn btn-primary component-button ">{{ __('backend/user.index.action.create') }}</a>
@endsection

@push('title')
    <h1>{{ __('backend/user.index.pagetitle') }}</h1>
@endpush

@include('useradmin::user.index-internal')
@endsection
