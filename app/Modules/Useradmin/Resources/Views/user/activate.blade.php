<div id="user_activate" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
    <form action="{{ route('useradmin.user.activate', ['user' => $user->id]) }}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="modal-title">Benutzer aktivieren</h4>
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
                                @if ($user->occupation && $user->occupation === \App\Models\User::USER_OCCUPATION_ORGANISATION)
                                    <h4>Soll der User "{!! $user->name !!}" also Organisator aktiviert werden?</h4>
                                    <p>Der User hat sich mit der Organisation: "<b>{{ $user->organisation_name }}</b>"
                                        registriert.</p>
                                @endif
                                @if ($user->occupation && $user->occupation === \App\Models\User::USER_OCCUPATION_PRIVATE)
                                    <h4>Soll der User "{!! $user->name !!}" aktiviert werden?</h4>
                                @endif
                                @if ($user->message && $user->message !== '')
                                    <p> Es wurde zudem die folgende Nachricht hinterlassen:</p>
                                    <p><b>{{ $user->message }}</b></p>
                                @endif
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
                                @if ($user->occupation && $user->occupation === \App\Models\User::USER_OCCUPATION_ORGANISATION)
                                    <input type="submit" class="component-button btn btn-primary"
                                        value="Benutzer mit der Rolle Organisator aktivieren"
                                        name="activate_organisator">
                                @else
                                    <input type="submit" class="component-button btn btn-primary"
                                        value="Benutzer aktivieren" name="activate">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    new bootstrap.Modal(document.getElementById('user_activate')).show();
</script>
