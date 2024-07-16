@section('content')
    @if (session('success'))
        <x-component-messages :messages="session('success')" messageType="success"
            messageTitle="{{ __('backend/accessdata.successTitle') }}" />
    @endif
    <x-component-descbox ariaLabel="{{ __('backend/dashboard.descbox.ariaLabel') }}"
        title="Willkommen {{ $user->getFullName() }}!" format="{{ __('backend/dashboard.descbox.format') }}"
                                                               helpLink="/backend/"

        :desc="$user->hasRole(['Organisator', 'Admin'])
            ? __('backend/dashboard.descbox.desc')
            : __('backend/dashboard.descbox.descPrivate')" />
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <x-component-dashboard-item title="Meetings" icon="fa-solid fa-video"
                    desc="{{ __('backend/dashboard.meeting.desc', ['meetingCount' => $meetings->count()]) }}"
                    ariaLabel="{{ __('backend/dashboard.meeting.ariaLabel') }}">
                    <a role="button" class="btn btn-secondary component-button"
                        href="{{ route('lag.meeting.index') }}">{{ __('backend/dashboard.meeting.index.linktext') }}</a>
                    <a role="button" class="btn btn-primary component-button"
                        href="{{ route('lag.meeting.create') }}">{{ __('backend/dashboard.meeting.create.linktext') }}</a>
                </x-component-dashboard-item>
            </div>
            <div class="col-12 col-lg-6">
                <x-component-dashboard-item title="Aufzeichnungen" icon="fa-solid fa-record-vinyl"
                    desc="{{ __('backend/dashboard.record.desc', ['recordingCount' => $recordings->count()]) }}"
                    ariaLabel="{{ __('backend/dashboard.record.ariaLabel') }}">
                    <a role="button" class="btn btn-secondary component-button"
                        href="{{ route('lag.recording.index') }}">{{ __('backend/dashboard.record.linktext') }}</a>
                </x-component-dashboard-item>
            </div>
            <div class="col-12 col-lg-6">
                @if ($user->isProfileComplete())
                    <x-component-dashboard-item title="{{ __('backend/dashboard.profile.ariaLabel') }}"
                        icon="fa-solid fa-user" desc="{{ __('backend/dashboard.profile.profileComplete') }}"
                        descId="profileDataStatus" desc2="{{ __('backend/dashboard.profile.profileCompleteDesc') }}"
                        desc2Id="meetingProfleStatus" hasProfileStatusField="true"
                        ariaLabel="{{ __('backend/dashboard.profile.ariaLabel') }}">
                        <a role="button" class="btn btn-secondary component-button"
                            href="{{ route('useradmin.profile.index') }}">{{ __('backend/dashboard.profile.personaData.linktext') }}</a>
                        <a role="button" class="btn btn-secondary component-button" href="{{ route('lag.wizard.intro') }}"
                            target="_blank">{{ __('backend/dashboard.profile.personalProfile.linktext') }}</a>
                        <a role="button" class="btn btn-secondary component-button"
                            href="{{ route('useradmin.profile.accessDataIndex') }}">
                            {{ __('backend/dashboard.profile.accessdata.linktext') }}</a>
                    </x-component-dashboard-item>
                @else
                    <x-component-dashboard-item title="{{ __('backend/dashboard.profile.ariaLabel') }}"
                        icon="fa-solid fa-user" desc="{{ __('backend/dashboard.profile.profileInComplete') }}"
                        descId="profileDataStatus" desc2="{{ __('backend/dashboard.profile.profileCompleteDesc') }}"
                        desc2Id="meetingProfleStatus" hasProfileStatusField="true"
                        ariaLabel="{{ __('backend/dashboard.profile.ariaLabel') }}">
                        <a role="button" class="btn btn-secondary component-button"
                            href="{{ route('useradmin.profile.index') }}">{{ __('backend/dashboard.profile.personaData.linktext') }}</a>
                        <a role="button" class="btn btn-secondary component-button" href="{{ route('lag.wizard.intro') }}"
                            target="_blank">{{ __('backend/dashboard.profile.personalProfile.linktext') }}</a>
                        <a role="button" class="btn btn-secondary component-button"
                            href="{{ route('useradmin.profile.accessDataIndex') }}">{{ __('backend/dashboard.profile.accessdata.linktext') }}</a>
                    </x-component-dashboard-item>
                @endif
            </div>
        </div>
    </div>
@endsection
