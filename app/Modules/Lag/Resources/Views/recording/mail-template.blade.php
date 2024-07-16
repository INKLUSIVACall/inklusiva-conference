<div id="recording_mailtemplate" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="modal-title">Mailvorlage für Aufnahme: {{ $recording['name'] }},
                                {{ $recording->getStartDateFormatted() }}</h4>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">&nbsp;</span></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <textarea rows="30" style="min-height: 40vh" id="mailtemplate">{{ $templateText }}</textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" data-bs-dismiss="modal" aria-hidden="true"
                                class="component-button btn btn-secondary me-3">schliessen</a>
                            <button class="component-button btn btn-primary"
                                onclick="document.getElementById('mailtemplate').select(); document.execCommand('copy');">
                                {{ __('backend/meeting.mailtemplate.copy') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new bootstrap.Modal(document.getElementById('recording_mailtemplate')).show();

    function copyText() {
        var copyText = document.getElementById("recording_mailtemplate").getElementsByTagName("textarea")[0];
        navigator.clipboard.writeText(copyText.value);

    }
</script>
