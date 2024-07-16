@extends('layouts.backend')
@section('pagetitle')
    {{__('backend/personaldata.edit.pagetitle')}}
@endsection
@section('content')
    @include('useradmin::profile.edit-data-internal')
@endsection
