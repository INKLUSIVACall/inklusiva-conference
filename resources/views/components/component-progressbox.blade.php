<div class="component component-progressbox">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1">
                <div class="items">
                    <div class="item status">
                        {{ __('wizard/progressbox.stepinfo', ['$wizardStep' => $wizardStep, '$wizardTotalSteps' => $wizardTotalSteps]) }}
                    </div>
                    <div class="item title">
                        {{ $title }}
                    </div>
                    <div class="item progresscontainer">
                        <div class="item progress-arrow left">
                            @yield('progressnav-left')
                        </div>
                        <div class="item progress">
                            <div class="sr-only">{{ __('wizard/progressbox.progressbar.ariaLabel', ['$wizardStep' => $wizardStep, '$wizardTotalSteps' => $wizardTotalSteps, '$wizardStepsPercentage' => round(($wizardStep / $wizardTotalSteps) * 100)]) }}</div>
                            <div class="progress-bar step-{{ $wizardStep }}" aria-hidden="true"
                                 style="width: {{ round((100 / $wizardTotalSteps) * $wizardStep,0) }}%;">
                                <div class="value">{{ round((100 / $wizardTotalSteps) * $wizardStep,0) }}%</div>
                            </div>
                        </div>
                        <div class="item  progress-arrow right">
                            @yield('progressnav-right')
                        </div>
                    </div>
                    <div class="item subtitle" aria-hidden="true">{{ __('wizard/progressbox.progressbar.subtitle') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
