@extends('layouts.backend')
@section('pagetitle')
    Nutzer ändern
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
        <button class="btn btn-primary component-button" onclick="document.getElementById('updateUserForm').submit();">
            speichern
        </button>

        <a role="button" class="btn btn-light component-button" href="{{ route('useradmin.user.index') }}">abbrechen
        </a>
    @endsection

    @push('title')
        <h1>Nutzer ändern</h1>
    @endpush

    <div class="container">
        @include('useradmin::user.edit-internal')
    </div>
@endsection
