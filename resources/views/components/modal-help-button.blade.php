<div id="help_button" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="modal-title">Hilfe</h4>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close  outline" data-bs-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">Schließen</span></button>
                </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <iframe class="help-modal" src="{{env('WIKI_BASE_URL')}}{{$helpLink}}" title="Hilfeseite"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" data-bs-dismiss="modal" aria-hidden="true"
                                class="component-button btn btn-secondary me-3">{{ __('helpButton.close') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
new bootstrap.Modal(document.getElementById('help_button')).show();
</script>
