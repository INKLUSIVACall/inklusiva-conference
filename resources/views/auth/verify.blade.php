@extends('layouts.backend-plain')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <x-component-whitebox class="login">
                    <div class="login-logo">
                        @include('layouts.includes.logo')
                    </div>
                    <h2 class="mb-5">Registrierungsanfrage eingegangen</h1>
                    <div>
                        <p>Vielen Dank für Ihre Registrierung. Ihre Anfrage wird nun von einem Administrator geprüft. Sie
                            erhalten eine E-Mail, sobald Ihre Anfrage bearbeitet wurde.</p>
                        <p>Bitte haben Sie Verständnis dafür, dass die Prüfung einige Zeit in Anspruch nehmen kann.</p>
                    </div>
                </x-component-whitebox>
            </div>
        </div>
    </div>
@endsection
