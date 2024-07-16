@extends('layouts.backend-plain')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-component-whitebox class="login">
                    <div class="login-logo">
                        @include('layouts.includes.logo')
                    </div>
                    <h2 class="mb-5">{{__('backend/instantmeeting.success.title')}}</h1>
                    <div>
                        <p>{{__('backend/instantmeeting.success.desc')}}</p>
                    </div>
                </x-component-whitebox>
            </div>
        </div>
    </div>
@endsection
