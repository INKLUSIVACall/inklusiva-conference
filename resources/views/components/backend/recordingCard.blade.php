<div class="card">
    <div class="row">
        <div class="col-3 d-flex align-items-center">
            <i class="fa-solid fa-film fa-4x"></i>
        </div>
        <div class="col-9">
        <h5 aria-hidden="true" class="card-title">{{ $recording->name }}</h5>
        <div aria-hidden="true">{{ $recording->getStartDateFormatted() }}</div>
        <div class="card-body">
            <a class="btn btn-outline-primary" role="button" href='{!! route('lag.recording.detail', ['id' => "$recording->id"]) !!}'><i class="fa-solid fa-pen"></i> Aufzeichnung verwalten</a>
            <a class="btn btn-outline-primary" role="button" href="#" hx-get="{!! route('lag.recording.confirmdestroy', ['recordingId' => "$recording->id"]) !!}" hx-target="#modalcontainer"
                ><i class="fas fa-trash-alt"></i> <span>Aufzeichnung entfernen</span></a>
        </div>
        </div>
    </div>
</div>
