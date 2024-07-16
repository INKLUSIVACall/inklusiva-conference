@extends('layouts.backend')
@section('pagetitle')
    {{__('backend/accessdata.pagetitle')}}
@endsection
@section('content')

    @if(session('success'))
        <x-component-messages
            :messages="session('success')"
            messageType="success"
            messageTitle="{{ __('backend/accessdata.successTitle') }}"/>
    @endif

    @include('useradmin::profile.accessdata-internal')
@endsection
