<div id="meeting_delete" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
    <form action="{{ route('lag.meeting.destroy', ['id' => $meeting->id]) }}" method="POST" id="destroyMeetingForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="modal-title">{{ __('backend/meeting.destroy.modalTitle') }}</h4>
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
                                <p>{{ __('backend/meeting.destroy.modalDesc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <a href="#" data-bs-dismiss="modal" aria-hidden="true"
                                    class="component-button btn btn-secondary me-3">{{ __('backend/meeting.destroy.cancel') }}</a>
                                <input type="submit" class="component-button btn btn-primary"
                                    value="{{ __('backend/meeting.destroy.submit') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    new bootstrap.Modal(document.getElementById('meeting_delete')).show();
</script>
