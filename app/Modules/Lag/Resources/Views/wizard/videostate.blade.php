@if (!$recordingExists)
    <p>
        Für dieses Meeting wurde die Möglichkeit einer Aufzeichnung aktiviert.
        Sobald die Aufzeichnung verfügbar ist, wird hier eine Aufzeichnung zum Download angezeigt.
    </p>
    <div class="loading-container">
        <div class="loading"></div>
    </div>
@else
    <p>
        Für dieses Meeting wurde die Möglichkeit einer Aufzeichnung aktiviert.
        Die Aufzeichnung ist verfügbar und kann hier heruntergeladen werden.
    </p>
    <a href="{{ route('meeting.download', ['meeting' => $meetingId]) }}" target="_blank"
        class="component-button btn btn-primary">
        Aufzeichnung herunterladen
    </a>
@endif
