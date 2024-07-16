@props(['recordings'])
<div class="row">
    <div class="col-lg-8 col-12">
        <h1>
            @if ($recordings->count() == 0)
                Bislang noch keine Aufzeichnungen
            @elseif ($recordings->count() == 1)
                1 Aufzeichnung
            @else
                {{ $recordings->count() }} Aufzeichnungen
            @endif
        </h1>
    </div>
</div>

<div class="recordings">
    @foreach ($recordings as $r)
        <div class="recording-item">
            <div class="recording-item-header">
                <div class="row">
                    <div class="col-md-10 col-12">
                        <h2>{{ $r->name }}</h2>
                    </div>
                    <div class="col-md-2 col-12 removebutton d-none d-md-block">
                        <a href="javascript:void(0)" hx-get="{{ route('lag.recording.confirmdestroy', ['recording' => $r]) }}" hx-target="#modalcontainer">
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
                <div class="recording-item-header-date">
                    <div class="title">Aufzeichnung vom</div>
                    {{$r->getStartDateFormatted()}}
                </div>
            </div>
            <div class="recording-item-buttons">
                <a href="{{ route('lag.recording.detail', $r) }}" class="btn btn-secondary component-button">
                    <i class="fas fa-xs fa-arrow-right"></i>
                    Details</a>
                <button hx-get="{{ route('lag.recording.confirmdestroy', $r) }}" hx-target="#modalcontainer"
                    class="btn btn-secondary component-button d-block d-md-none">
                    <i class="fas fa-xs fa-trash"></i>
                    Entfernen</button>
            </div>
        </div>
    @endforeach
</div>
