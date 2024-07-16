@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message')
    Entschuldigung. Sie haben die Seite zu lange nicht bearbeitet. Das Formular ist abgelaufen.<br>
    Sie können die Seite neu laden und erneut versuchen.<br><
    Falls das nicht funktioniert, melden Sie sich bitte <a class="font-semibold underline" href="route('login')">hier</a> wieder an und versuchen Sie es erneut.<br>
@endsection
