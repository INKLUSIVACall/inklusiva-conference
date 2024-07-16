@props( [
'elementTitleText' => '',
'elementTitleBook' => '',
'elementTitleSmall' => '',
'elementAsLabel' => '',
'elementIcon' => '',
'elementDesc' => '',
'elementId' => '',
'elementName' => '',
'elementValue' => '',
'noMarginBottom' => '',
])
<div class="component component-form-element component-form-element-textarea @if ($noMarginBottom != '') no-margin-bottom @endif">
    <x-inputs.component-generate-form-element-title-desc
        elementAsLabel="{{$elementAsLabel}}"
        elementTitleText="{{$elementTitleText}}"
        elementTitleBook="{{$elementTitleBook}}"
        elementTitleSmall="{{$elementTitleSmall}}"
        elementIcon="{{$elementIcon}}"
        elementDesc="{{$elementDesc}}"
        elementId="{{$elementId}}"
    />
    <textarea id="{{ $elementId }}" name="{{ $elementName }}" @if($elementDesc!='') aria-describedby="{{ $elementId }}_description" @endif>{{ $elementValue }}</textarea>
</div>
