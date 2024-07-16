@extends('layouts.backend-plain')
@section('pagetitle')
    Passwort zurücksetzen
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row mt-5">
                    <div class="col-8 offset-2">
                        @if (session('success'))
                            :messages="session('success')"
                            <x-component-messages messageType="success"
                                messageTitle="{{ __('backend/user.index.successTitle') }}" />
                        @endif
                        @if (session('errors'))
                            <x-component-messages :messages="session('errors')" messageType="error" />
                        @endif
                    </div>
                </div>

                <x-component-whitebox class="login">
                    <div class="login-logo">
                        @include('layouts.includes.logo')
                    </div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <x-inputs.inputfield elementTitleText="{{ __('E-Mail Adresse') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="email"
                            elementName="email" allowSubmit="true" elementPlaceholder="" elementType="email"
                            :elementValue="$email ?? old('email')">
                        </x-inputs.inputfield>
                        <x-inputs.inputfield elementTitleText="{{ __('Passwort') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="password"
                            elementName="password" allowSubmit="true" elementType="password" :elementValue="old('name')">
                        </x-inputs.inputfield>
                        <x-inputs.inputfield elementTitleText="{{ __('Passwort bestätigen') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementId="password_confirmation"
                            elementName="password_confirmation" allowSubmit="true" elementType="password">
                        </x-inputs.inputfield>
                        <div class="col-12 align-end">
                            <button type="submit" class="component-button btn btn-primary">
                                {{ __('Passwort setzen') }}
                            </button>
                        </div>
                    </form>

                    <div class="mt-5 mb-3">
                        <strong>{{__('auth.password.length')}}</strong>
                    </div>
                </x-component-whitebox>
            </div>
        </div>
    </div>
@endsection
