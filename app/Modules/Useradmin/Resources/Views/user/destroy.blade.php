<div id="user_delete" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
    <form action="{{ route('useradmin.user.destroy', $user->id) }}" method="POST" id="destroyUserForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="modal-title">User entfernen</h4>
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
                                <h4>Soll der User {!! $user->name !!} wirklich entfernt werden?</h4>
                                <p>Nach dem Entfernen steht der User nicht mehr zur Verfügung. Diese Aktion kann nicht
                                    rückgängig gemacht werden.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <a href="#" data-bs-dismiss="modal" aria-hidden="true"
                                                                    class="component-button btn btn-secondary">abbrechen</a>
                                <input type="submit" class="component-button btn btn-primary" value="entfernen">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    new bootstrap.Modal(document.getElementById('user_delete')).show();
</script>
