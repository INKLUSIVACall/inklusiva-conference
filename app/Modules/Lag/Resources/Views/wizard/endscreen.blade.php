@extends('layouts.backend-plain')
@section('pagetitle')
    {{ __('wizard/endscreen.title') }}
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
                    @if (!$thankYou)
                        <form method="POST" action="{{ route('endscreen.store', ['meeting' => $meetingId]) }}">
                            @csrf

                            <div class="login-logo">
                                @include('layouts.includes.logo')
                            </div>


                            <h2 class="mb-5">{{ __('wizard/endscreen.title') }} "{{ $meeting->name_display }}"</h2>

                            @if ($meeting->shouldRecord == 0 && $videoDirExists)
                                <div class="mb-5">
                                    <h3>Aufzeichnung</h3>
                                    <div hx-get="{{ route('meeting.refreshVideoState', ['meeting' => $meetingId]) }}"
                                        hx-trigger="every 10s">
                                        @include('lag::wizard.videostate')
                                    </div>
                                </div>
                            @endif

                            <h3>Bewertung</h3>
                            <p>{{ __('wizard/endscreen.intro') }}</p>

                            <div class="mt-5">
                                <h3>{{ __('wizard/endscreen.rating.intro') }}</h3>
                                <p> {{ __('wizard/endscreen.rating.intro.desc') }}</p>
                                <sl-rating label="{{ __('wizard/endscreen.rating.desc') }}"
                                    style="--symbol-size: 2rem;"></sl-rating>
                                <input type="hidden" name="rating" id="rating" value="0">
                            </div>


                            <div class="mt-5">
                                <h3>{{ __('wizard/endscreen.barrier.title') }}</h3>
                                <x-inputs.textarea elementTitleBook="" elementTitleSmall="true" elementAsLabel="true"
                                    elementId="barrier" elementName="barrier" noMarginBottom="true"
                                    elementValue="{{ old('barrier', '') }}">
                                </x-inputs.textarea>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="component-button btn btn-primary">
                                            {{ __('wizard/endscreen.submit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                const rating = document.querySelector('sl-rating');
                                rating.addEventListener('sl-change', event => {
                                    document.getElementById('rating').value = rating.value;
                                });
                            </script>
                        </form>
                    @else
                        <div class="login-logo">
                            @include('layouts.includes.logo')
                        </div>

                        <h2 class="mt-5 mb-3">{{ __('wizard/endscreen.thankyou') }}</h4>
                            <p>{{ __('wizard/endscreen.thankyou.close') }}</p>

                            @if ($meeting->shouldRecord == 0 && $videoDirExists)
                                <div class="mb-5 mt-5">
                                    <h3>Aufzeichnung</h3>
                                    <div hx-get="{{ route('meeting.refreshVideoState', ['meeting' => $meetingId]) }}"
                                        hx-trigger="every 10s">
                                        @include('lag::wizard.videostate')
                                    </div>
                                </div>
                            @endif
                    @endif
                </x-component-whitebox>
            </div>
        </div>
    </div>
@endsection
