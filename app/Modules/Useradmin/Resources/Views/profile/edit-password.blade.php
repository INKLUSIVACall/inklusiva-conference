@extends('layouts.backend')
@section('pagetitle')
    {{__('backend/accessdata.editPassword.pagetitle')}}
@endsection
@section('content')

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

@include('useradmin::profile.edit-password-internal')

@endsection
