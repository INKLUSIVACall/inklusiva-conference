@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
    Die angeforderte Seite konnte nicht gefunden werden.<br>
    <a class="font-semibold underline" href="{{route('base.home')}}">Hier</a> gelangen Sie zur Startseite.
@endsection
