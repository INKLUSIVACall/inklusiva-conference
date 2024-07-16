@props([
    'helpLink' => null,
    'title' => '',
])
<a class="component help-button outline" aria-label="Hilfe öffnen" href="#"
    hx-get = "{{ route('lag.general.helpButton') }}" hx-target = "#modalcontainer" hx-vals='{"link": "{{$helpLink}}"}'>
    <div class="help-icon">
        <i class="fa-solid fa-info"></i>
     </div>
     <div class="help-title">
        {{ $title }}
     </div>
 </a>
