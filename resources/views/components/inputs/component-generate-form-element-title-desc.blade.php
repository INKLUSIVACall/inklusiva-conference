@props( [
'elementTitleText' => '',
'elementTitleBook' => '',
'elementTitleSmall' => '',
'elementAsLabel' => '',
'elementAsLegend' => '',
'elementIcon' => '',
'elementDesc' => '',
'elementId' => '',
])
<div class="element-title-desc">
    <div class="title  @if($elementTitleBook!='') book @endif @if($elementTitleSmall!='') small @endif">
        @if($elementIcon!='')
            <div class="icon" aria-hidden="true">
                <i class="{{ $elementIcon }}"></i>
            </div>
        @endif
        @if($elementAsLabel!='')
            <label class="label" for="{{ $elementId }}" id="{{ $elementId }}_label">
                {{ $elementTitleText }}
            </label>
        @elseif($elementAsLegend!='')
            <legend class="legend" id="{{ $elementId }}_legend">
                {!! $elementTitleText !!}
            </legend>
        @else
            <div class="label">
                {!! $elementTitleText !!}
            </div>
        @endif
    </div>
    @if($elementDesc!='')
        <div class="desc" id="{{ $elementId }}_description">
            {!! $elementDesc !!}
        </div>
    @endif
</div>
