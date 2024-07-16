<x-component-whitebox title="Aufzeichnung Details" class="recording-details">

    <h2>Details zum Meeting</h2>
    <div class="valuebox">
        <label>Titel </label>
        <span>{{ $recording->name }}</span>
    </div>
    <div class="valuebox">
        <label>Datum</label>
        <span>{{ $recording->getStartDateFormatted() }}</span>
    </div>
    <h2>Aufzeichnung</h2>
    <div class="valuebox">
        <a href="{{ route('meeting.download', ['meeting' => $recording->meetingUUID]) }}" target="_blank"
        class="component-button btn btn-primary">
        Aufzeichnung herunterladen
    </a>
    </div>
    <p class="mt-5 mb-5"><small><i>Die Aufnahme steht für 7 Tage nach Meetingabschluss als URL zur Verfügung und wird
                automatisch am {{ $recording->getStartDateFormatted() }} gelöscht. </i></small></p>

    <a href="#" hx-get="{!! route('lag.recording.mailTemplate', ['recording' => $recording]) !!}" hx-target="#modalcontainer" role="button"><i
            class="fa-solid fa-envelope"></i><span>Mailvorlage erzeugen</span></a>
</x-component-whitebox>
