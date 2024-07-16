@extends('layouts.backend')
@section('pagetitle')
    Aufzeichnung verwalten
@endsection

@section('content')
    @section('formcontrols')
        <a class="btn btn-primary component-button" href="{{ route('lag.recording.index') }}">zur Liste aller Aufzeichnungen
        </a>
    @endsection

    @push('title')
    <h1>Aufzeichnung Details</h1>
    @endpush

    <div class="container">
        @include('lag::recording.detail-internal')
    </div>
@endsection
