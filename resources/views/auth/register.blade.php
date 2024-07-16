@extends('layouts.backend-plain')
@section('pagetitle')
    Registrierungsanfrage
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <x-component-whitebox class="login">
                    <div class="login-logo">
                        @include('layouts.includes.logo')
                    </div>

                    <h1 class="mt-5 mb-5">Registrierungsanfrage</h1>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mt-5"></div> <!-- TODO: remove this when the select component is fixed -->

                        <x-inputs.inputfield elementTitleText="{{ __('backend/register.firstname') }}"
                            elementTitleSmall="true" noMarginBottom="true" elementAsLabel="true" elementIcon=""
                            elementDesc="" elementId="firstname" elementName="firstname" allowSubmit="true"
                            elementPlaceholder="" elementType="text" :elementValue="$firstname ?? old('firstname')">
                        </x-inputs.inputfield>

                        <x-inputs.inputfield elementTitleText="{{ __('backend/register.lastname') }}"
                            elementTitleSmall="true" noMarginBottom="true" elementAsLabel="true" elementIcon=""
                            elementDesc="" elementId="lastname" elementName="lastname" allowSubmit="true"
                            elementPlaceholder="" elementType="text" :elementValue="$lastname ?? old('lastname')">
                        </x-inputs.inputfield>

                        <x-inputs.inputfield elementTitleText="{{ __('backend/register.email') }}" elementTitleSmall="true"
                            noMarginBottom="true" elementAsLabel="true" elementIcon="" elementDesc="" elementId="email"
                            elementName="email" allowSubmit="true" elementPlaceholder="" elementType="email"
                            :elementValue="$email ?? old('email')">
                        </x-inputs.inputfield>

                        <x-inputs.radio elementTitleText="{{ __('backend/personaldata.edit.input.occupationName') }}"
                            elementTitleSmall="true" elementAsLabel="" elementAsLegend="true" elementIcon=""
                            noMarginBottom="true" elementDesc="{{ __('backend/personaldata.edit.input.occupationDesc') }}"
                            elementId="occupation" elementName="occupation" radioRow="true" :options="[
                                'privat' => __('backend/personaldata.edit.input.occupationValuePrivate'),
                                'organisation' => __('backend/personaldata.edit.input.occupationValueOrganisation'),
                            ]"
                            :selected="old('occupation')" />

                        <x-inputs.inputfield elementTitleText="{{ __('backend/personaldata.edit.input.nameOrganisation') }}"
                            elementTitleSmall="true" elementAsLabel="true" elementIcon="" elementDesc=""
                            elementId="organisation_name" elementName="organisation_name" noMarginBottom="true"
                            elementPlaceholder="{{ __('backend/personaldata.edit.input.nameOrganisationPlaceholdder') }}"
                            :elementValue="old('name')">
                        </x-inputs.inputfield>

                        <x-inputs.textarea elementTitleText="{{ __('backend/register.message') }}" elementTitleBook=""
                            elementTitleSmall="true" elementAsLabel="true" elementId="message" elementName="message"
                            elementValue="{{ old('message', '') }}">
                        </x-inputs.textarea>

                        <x-inputs.toggle-simple elementLabel="{!!__('backend/register.privacypolicy') !!}" elementId="privacy"
                                elementName="privacy" :value="old('privacy')" />

                        <div class="row mt-3">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="component-button btn btn-primary">
                                    {{ __('backend/register.send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </x-component-whitebox>
            </div>
        </div>
    </div>
@endsection
