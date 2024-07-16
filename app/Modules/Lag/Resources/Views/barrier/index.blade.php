@if (isset($success))
    <div class="modal" tabindex="-1" id="barrierModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="mb-4">
                                @if (isset($success))
                                    <x-component-messages :messages="$success" messageTitle="" messageType="success" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <form>
        @csrf
        <div class="modal" tabindex="-1" id="barrierModal">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('barrier.title') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-4">
                                @if (isset($errors))
                                    <x-component-messages :messages="$errors" messageType="error" />
                                @endif
                            </div>
                            <div class="col-12">

                                <div class="wysiwyg ">
                                    <p>{{ __('barrier.desc') }}</p>
                                    <p><b>{{ __('barrier.url') }}</b><br>
                                        {{ URL::current() }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="hidden" id="url" name="url" placeholder=""
                                    value="https://lag-inklusiva-call.4morgen.de/" readonly="">
                                <label for="barriereemail" id="label_barriereemail">E-Mail</label>
                                <input type="text" autocomplete="off" id="barriereemail" name="barriereemail"
                                    placeholder="E-Mail eingeben"
                                    value="{{ old('barriereemail', Request::get('barriereemail')) }}" class="">
                            </div>
                            <div class="col-12 form-col">
                                <label for="barrieretext" id="label_barrieretext">Mitteilung</label>
                                <textarea id="barrieretext" name="barrieretext" placeholder="Nachricht eingeben" class="">{{ old('barrieretext', Request::get('barrieretext')) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" hx-post="{{ route('barrier.store') }}" id="barrierForm"
                            hx-target="#modalcontainer"
                            class="btn btn-primary component-button">{{ __('barrier.button') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif
<script>
    var myModal = new bootstrap.Modal('#barrierModal', {
        keyboard: false,
        backdrop: false
    })

    myModal.show();

    document.querySelector('body').removeAttribute('data-bs-overflow');
    document.querySelector('body').removeAttribute('data-bs-padding-right');
</script>
<style>
    .message {
        padding-left: 0;
        padding-right: 0;
    }

    .message .container {
        padding-left: 0;
        padding-right: 0;
        margin-left: 0;
        margin-right: 0;
    }

    .modal .modal-dialog {
        min-width: auto;
    }
</style>
