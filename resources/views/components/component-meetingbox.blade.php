@props(['meetings'])
<div class="row">
    <div class="col-lg-8 col-12">
        <h1>
            @if ($meetings->count() == 0)
                Keine geplanten Meetings
            @elseif ($meetings->count() == 1)
                1 geplantes Meeting
            @else
                {{ $meetings->count() }} geplante Meetings
            @endif
        </h1>
    </div>
    <div class="col-lg-4 col-12 text-end">
        <a href="{{ route('lag.meeting.create') }}" class="btn btn-secondary component-button">
            <i class="fas fa-arrow-right"></i>
            Neues Meeting</a>
    </div>
</div>
@foreach ($meetings as $meeting)
    <div class="meeting-item">
        <div class="meeting-item-header">
            <div class="row">
                <div class="col-md-10 col-12">
                    @if(isset($meeting->name_display))
                        <h2>{{ $meeting->name_display }}</h2>
                    @endif
                </div>
                <div class="col-md-2 col-12 removebutton d-none d-md-block">
                    <a href="javascript:void(0)" hx-get="{{ route('lag.meeting.confirmdestroy', $meeting) }}"
                        hx-target="#modalcontainer">
                        <div class="text-circle">
                            <div class="circle" aria-hidden="true">
                                <i class="fas fa-xs fa-trash"></i>
                            </div>
                            <div class="text">
                                Entfernen
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @if ($meeting->start !== null)
                <div class="meeting-item-header-date">
                    <div class="title">Meeting startet am</div>
                    <div class="date @if ($meeting->start < now()) past @endif">
                        {{ $meeting->start->format('d.m.Y') }}
                        um {{ $meeting->start->format('H:i') }}
                        Uhr</div>
                </div>
            @else
                <div class="meeting-item-header-date">
                    <div class="title">Dauerhaftes Meeting</div>
                </div>
            @endif
        </div>
        <div class="meeting-meta">
            @if ($meeting->should_record)
                <div class="meeting-meta-item active">
                    <div class="circle">
                        <i class="fas fa-xs fa-video"></i>
                    </div>
                    <span>Meeting mit Aufzeichnung</span>
                </div>
            @else
                <div class="meeting-meta-item">
                    <div class="circle">
                        <i class="fas fa-xs fa-video"></i>
                    </div>
                    <span>Meeting ohne Aufzeichnung</span>
                </div>
            @endif
            @if ($meeting->isRunning())
                <div class="meeting-meta-item active">
                    <div class="circle">
                        <i class="fas fa-2xs fa-video"></i>
                    </div>
                    <span>Meeting läuft</span>
                </div>
            @endif
        </div>
        <div class="meeting-item-buttons">
            <a href="{{ route('lag.meeting.detail', $meeting) }}" class="btn btn-secondary component-button">
                <i class="fas fa-xs fa-arrow-right"></i>
                Details und Einladungslinks</a>
            <a href="{{ route('lag.wizard.intro', ['id' => $meeting->getMeetingUUIDModerator()]) }}" target="_blank"
                role="button" class="btn btn-secondary component-button">
                <i class="fas fa-xs fa-arrow-right"></i> Als Moderator teilnehmen</a>
            <button hx-get="{{ route('lag.meeting.confirmdestroy', $meeting) }}" hx-target="#modalcontainer"
                class="btn btn-secondary component-button d-block d-md-none">
                <i class="fas fa-xs fa-trash"></i>
                Entfernen</button>

            <a href="@if ($meeting->start == null || $meeting->start > now()) {{ route('lag.meeting.edit', $meeting) }} @else javascript:void(0) @endif"
               class="btn btn-secondary component-button @if ($meeting->start < now() && $meeting->start != null) past @endif">
                <i class="fas fa-xs fa-edit"></i>
                Ändern</a>
        </div>
    </div>
@endforeach
