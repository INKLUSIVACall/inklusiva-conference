@extends('layouts.backend-plain')
@section('pagetitle')
    Login
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

                    <form method="POST" class="component-form" action="{{ route('login') }}">
                        <h1 class="sr-only mt-5 mb-5">Login</h1>
                        @csrf
                        <x-inputs.inputfield elementTitleText="{{ __('backend/login.username') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="email"
                            elementName="email" allowSubmit="true" elementPlaceholder="" elementType="email"
                            :elementValue="$email ?? old('email')">
                        </x-inputs.inputfield>

                        <x-inputs.inputfield elementTitleText="{{ __('backend/login.password') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="password"
                            elementName="password" allowSubmit="true" elementPlaceholder="" elementType="password"
                            :elementValue="$password ?? old('password')">
                        </x-inputs.inputfield>

                        <x-inputs.toggle-simple elementLabel="{{ __('backend/login.rememberMe') }}" elementId="remember" elementName="remember"
                            innerClass="mb-0" :value="old('remember')" />

                        <div class="col-12 text-end mb-5">
                            <button type="submit" class="btn btn-primary component-button  text-md-end text-end">
                                        {{ __('backend/login.login') }}
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 text-lg-start text-md-end text-end">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="outline">
                                        {{ __('backend/login.forgotPassword') }}
                                    </a>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-12 text-lg-end text-md-end text-end">
                                <a href="{{ route('register') }}" class="outline">
                                    {{ __('backend/login.register') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </x-component-whitebox>
            </div>
        </div>
    </div>
@endsection
