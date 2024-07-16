<div class="component component-steps">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="Navigation" id="wnavigation">
                    <ul>
                        <li class=" @if($active === 'about') active @endif">
                            <a href="#"
                               @if($active !== 'about') @if(isset($meeting) && $meeting !== null) onclick="submitStepForm('about', '{{ $meeting->getMeetingUUID($role) }}')"
                               @else onclick="submitStepForm('about')" @endif @endif>
                                Basis
                            </a>
                        </li>
                        <li class=" @if($active === 'visual') active @endif">
                            <a href="#"
                               @if($active !== 'visual') @if(isset($meeting) && $meeting !== null) onclick="submitStepForm('visual', '{{ $meeting->getMeetingUUID($role) }}')"
                               @else onclick="submitStepForm('visual')" @endif @endif>
                                Sehen
                            </a>
                        </li>
                        <li class=" @if($active === 'audio') active @endif">
                            <a href="#"
                               @if($active !== 'audio') @if(isset($meeting) && $meeting !== null) onclick="submitStepForm('audio', '{{ $meeting->getMeetingUUID($role) }}')"
                               @else onclick="submitStepForm('audio')" @endif @endif>
                                Hören
                            </a>
                        </li>
                        <li class=" @if($active === 'distress') active @endif">
                            <a href="#"
                               @if($active !== 'distress') @if(isset($meeting) && $meeting !== null) onclick="submitStepForm('distress', '{{ $meeting->getMeetingUUID($role) }}')"
                               @else onclick="submitStepForm('distress')" @endif @endif>
                                Notfall
                            </a>
                        </li>
                        <li class=" @if($active === 'translate') active @endif">
                            <a href="#"
                               @if($active !== 'translate') @if(isset($meeting) && $meeting !== null) onclick="submitStepForm('translate', '{{ $meeting->getMeetingUUID($role) }}')"
                               @else onclick="submitStepForm('translate')" @endif @endif>
                                Dolmetschen
                            </a>
                        </li>
                        @if($role === 'captioner')
                        <li class=" @if($active === 'captioning') active @endif">
                            <a href="#"
                               @if($active !== 'captioning') @if(isset($meeting) && $meeting !== null) onclick="submitStepForm('captioning', '{{ $meeting->getMeetingUUID($role) }}')"
                               @else onclick="submitStepForm('captioning')" @endif @endif>
                                Schriftdolmetschen
                            </a>
                        </li>
                        @endif
                        <li class=" @if($active === 'summary') active @endif">
                            <a href="#"
                               @if($active !== 'summary') @if(isset($meeting) && $meeting !== null) onclick="submitStepForm('summary', '{{ $meeting->getMeetingUUID($role) }}')"
                               @else onclick="submitStepForm('summary')" @endif @endif>
                                Zusammenfassung
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@section('formcontrols')
    <input  type="button"
            class="btn btn-primary component-button" aria-describedby="buttondesc"
            @if(isset($disableSubmit) && $disableSubmit === true) disabled @endif
            @if(isset($submitMessage) && $submitMessage !== null)
            onclick="submitStepForm('{{ $nextStep }}',  '{{ $submitMessage }}')"
            @else
            onclick="submitStepForm('{{ $nextStep }}')"
            @endif
            @if(!isset($submitButtonLabel) || $submitButtonLabel === null) value="{{ __('wizard/intro.formcontrols.submit.value') }}"
            @else value="{{ $submitButtonLabel }}" @endif />
    <span aria-hidden="true" style="display: none"
          id="buttondesc">{{ __('wizard/intro.formcontrols.submit.value') }}</span>
@endsection

<script>
    /**
     * Adds a hidden field for the next step to the form and submits it.
     *
     * @param {string} target - The target step, should be one of the following: intro, visual, audio, distress, translate, summary
     */
    function submitStepForm(target, submitMessage = null) {
        var form = document.getElementById("stepForm");

        // add a hidden field for the target step
        var targetInput = document.createElement("input");
        targetInput.setAttribute("type", "hidden");
        targetInput.setAttribute("name", "targetStep");
        targetInput.setAttribute("value", target);
        form.appendChild(targetInput);

        if(submitMessage !== null) {
            var messageInput = document.createElement("input");
            messageInput.setAttribute("type", "hidden");
            messageInput.setAttribute("name", "submitMessage");
            messageInput.setAttribute("value", submitMessage);
            form.appendChild(messageInput);
        }

        form.requestSubmit();
    }
</script>
