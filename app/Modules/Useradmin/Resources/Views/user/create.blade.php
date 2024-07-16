@extends('layouts.backend')
@section('pagetitle')
    Nutzer anlegen
@endsection

@section('content')
    @if(session('success'))
        <x-component-messages
            :messages="session('success')"
            messageType="success"
            messageTitle="{{ __('backend/user.index.successTitle') }}"/>
    @endif

    @if(session('errors'))
        <x-component-messages
            :messages="session('errors')"
            messageType="error"/>
    @endif

    @section('formcontrols')
        <button class="component-button btn btn-primary" onclick="document.getElementById('createUserForm').submit();">
            speichern
        </button>

        <a class="component-button btn btn-light" href="{{ route('useradmin.user.index') }}">abbrechen
        </a>
    @endsection

    @push('title')
    <h1>Nutzer anlegen</h1>
    @endpush

    @include('useradmin::user.create-internal')
@endsection
