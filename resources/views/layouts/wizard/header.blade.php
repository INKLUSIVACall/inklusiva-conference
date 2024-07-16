<div data-type="area" data-area-type="header" data-area-id="header">
    <div data-type="area-wrapper">
        <header aria-label="Headerbereich">
            <div class="component header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="items">
                                <div class="item logo dnone">
                                    @include('layouts.includes.logo')
                                </div>
                                <div class="item title">
                                    @if ($meeting !== null)
                                        @if ($meeting->start != null)
                                            <div class="meeting-date">
                                                Beginn {{ $meeting->start->format('d.m.Y') }}
                                                um {{ $meeting->start->format('H:i') }} Uhr
                                            </div>
                                        @else
                                            <div class="meeting-date">
                                                Dauerhaftes Meeting
                                            </div>
                                        @endif
                                        <div class="meeting-title" id="headerMeetingTitle">
                                            {{ $meeting->name_display }}
                                        </div>
                                        <a href="{{ route('base.home') }}" class="mt-3 outline component-textlink">
                                            <i class="icon fa-solid fa-arrow-right"></i>
                                            zur Startseite</a>
                                    @else
                                        <div class="meeting-title" id="headerMeetingTitle">
                                            <h1> {{ __('wizard/header.headerTitleNoMeeting') }}</h1>
                                        </div>
                                        <a href="{{ route('base.home') }}" class="mt-3 outline component-textlink">
                                            <i class="icon fa-solid fa-arrow-right"></i>
                                            zur Startseite</a>
                                    @endif
                                </div>

                                <div class="item language d-none d-lg-block">
                                    <x-inputs.langSelect></x-inputs.langSelect>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>
