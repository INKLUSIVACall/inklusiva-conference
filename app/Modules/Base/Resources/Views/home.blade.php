@extends('layouts.backend')
@section('pagetitle')
    {{__('backend/dashboard.pagetitle')}}
@endsection
@section('content')
    @include('base::home-internal')

    @push('scripts')
    @vite('resources/js/views/backend/dashboard.js')
    @endpush
@endsection
