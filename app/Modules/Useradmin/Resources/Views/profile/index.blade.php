@extends('layouts.backend')
@section('pagetitle')
    {{__('backend/personaldata.index.pagetitle')}}
@endsection
@section('content')

    @if(session('success'))
        <x-component-messages
            :messages="session('success')"
            messageType="success"
            messageTitle="{{ __('backend/personaldata.index.successTitle') }}"/>
    @endif

@include('useradmin::profile.index-internal')
@endsection
