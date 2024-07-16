@props( [
'icon' => '',
'title' => '',
'value' => '',
'ariaLabelForTitle' => '',
'ariaLabelForValue' => ''
])
<div class="datacollection-item">
    <div class="key">
        @if ($icon!='')
            <div class="icon" aria-hidden="true">
                <i class="{{$icon}}"></i>
            </div>
        @endif
        <div class="title" @if ($ariaLabelForTitle) aria-label="{{$ariaLabelForTitle}}" @endif>
            {{$title}}
        </div>
    </div>
    <div class="value" @if ($ariaLabelForValue === '') aria-hidden="true" @endif>
        {{$value}}
    </div>
</div>
