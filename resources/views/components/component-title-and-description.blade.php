@props( [
'elementTitleText' => '',
'elementTitleBook' => '',
'elementTitleSmall' => '',
'elementAsLabel' => '',
'elementIcon' => '',
'elementDesc' => '',
'elementId' => '',
])
<div class="component component-form-element" id="component_{{ $elementId }}">
    <x-inputs.component-generate-form-element-title-desc
        elementAsLabel="{{$elementAsLabel}}"
        elementTitleText="{{$elementTitleText}}"
        elementTitleBook="{{$elementTitleBook}}"
        elementTitleSmall="{{$elementTitleSmall}}"
        elementIcon="{{$elementIcon}}"
        elementDesc="{{$elementDesc}}"
        elementId="{{$elementId}}"
    />

    <div class="element-values">
        {{$slot}}
    </div>
</div>

