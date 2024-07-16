@extends('layouts.backend-plain')
@section('pagetitle')
    Passwort vergessen
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

                    <form method="POST" class="component-form" action="{{ route('password.email') }}">

                        <h1 class="mt-5 mb-5">Passwort vergessen?</h1>

                        @csrf
                        <fieldset>
                            <legend> {{ __('Geben Sie hier Ihre E-Mail-Adresse ein und wir werden Ihnen einen Link zum Zurücksetzen ihres Passworts zusenden.') }}
                            </legend>

                            <x-inputs.inputfield elementTitleText="{{ __('E-Mail Adresse') }}" elementTitleSmall="true"
                                noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="email"
                                elementName="email" allowSubmit="true" elementPlaceholder="" elementType="email"
                                :elementValue="$email ?? old('email')">
                            </x-inputs.inputfield>

                            <div class="col-12 align-end">
                                <button type="submit" class="component-button btn btn-primary">
                                    {{ __('Passwort zurücksetzen') }}
                                </button>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-6 col-md-12 text-lg-start text-md-end text-end">
                                </div>
                                <div class="col-lg-6 col-md-12 text-lg-end text-md-end text-end">
                                    <a class="outline" href="{{ route('login') }}"> {{ __('Zurück zum Login') }} </a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </x-component-whitebox>
            </div>
        </div>
    </div>
@endsection
