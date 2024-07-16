@extends('layouts.backend-plain')
@section('pagetitle')
    Spontanes Meeting
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <x-component-whitebox class="login">
                    <div class="login-logo">
                        @include('layouts.includes.logo')
                    </div>

                    <h1 class="mt-5 mb-5">{{__('backend/instantmeeting.title')}}</h1>

                    <p>{{__('backend/instantmeeting.description')}}</p>

                    <form method="POST" action="{{ route('lag.instantmeeting.sendRegistration') }}">
                        @csrf

                        <x-inputs.inputfield elementTitleText="{{ __('backend/instantmeeting.firstname') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="firstname"
                            elementName="firstname" allowSubmit="true" elementPlaceholder="" elementType="text"
                            :elementValue="$firstname ?? old('firstname')">
                        </x-inputs.inputfield>

                        <x-inputs.inputfield elementTitleText="{{ __('backend/instantmeeting.lastname') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="lastname"
                            elementName="lastname" allowSubmit="true" elementPlaceholder="" elementType="text"
                            :elementValue="$lastname ?? old('lastname')">
                        </x-inputs.inputfield>

                        <x-inputs.inputfield elementTitleText="{{ __('backend/instantmeeting.email') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="email"
                            elementName="email" allowSubmit="true" elementPlaceholder="" elementType="email"
                            :elementValue="$email ?? old('email')">
                        </x-inputs.inputfield>

                        <x-inputs.inputfield elementTitleText="{{ __('backend/instantmeeting.meetingtitle') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="meetingTitle"
                            elementName="meetingTitle" allowSubmit="true" elementPlaceholder="" elementType="text"
                            :elementValue="$meetingTitle ?? old('meetingTitle')">
                        </x-inputs.inputfield>

                        <x-inputs.toggle-simple elementLabel="{!!__('backend/register.privacypolicy') !!}" elementId="privacy"
                                elementName="privacy" :value="old('privacy')" />

                        <div class="row mt-3">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="component-button btn btn-primary">
                                    {{ __('backend/instantmeeting.send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </x-component-whitebox>
            </div>
        </div>
    </div>
    </div>
@endsection
