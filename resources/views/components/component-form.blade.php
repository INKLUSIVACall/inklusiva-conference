<form id="{{ $id }}" method="{{ $method }}" action="{{ $action }}" @if (isset($enctype)) enctype="{{ $enctype }}" @endif>
    @csrf
    @if ($meeting !== null)
        <input type="hidden" name="meeting" value="{{ $meeting->name }}">
        <input type="hidden" name="meeting_id" value="{{ $meeting->getMeetingUUID($role) }}">
    @endif
    {{ $slot }}
</form>
