@props( [
'elementTitleText' => '',
'elementTitleBook' => '',
'elementTitleSmall' => '',
'elementAsLabel' => '',
'elementIcon' => '',
'elementDesc' => '',
'elementId' => '',
'elementName' => '',
'value' => '',
'onChange' => null
])
<div class="component component-form-element component-form-element-toggle-and-label">
    <x-inputs.component-generate-form-element-title-desc
        elementTitleText="{{$elementTitleText}}"
        elementTitleBook="{{$elementTitleBook}}"
        elementTitleSmall="{{$elementTitleSmall}}"
        elementAsLabel="{{$elementAsLabel}}"
        elementIcon="{{$elementIcon}}"
        elementDesc="{!!$elementDesc !!}"
        elementId="{{$elementId}}"
    />
    <div class="element-values">
        <div class="form-check form-switch on-off-label">
            <input aria-labelledby="label_screenreader_{{ $elementId }}"
            class="form-check-input" role="switch" id="{{ $elementId }}"
            name="{{ $elementName }}" type="hidden" name="{{ $elementName }}" value="0">
            <input aria-labelledby="label_screenreader_{{ $elementId }}"
                   class="form-check-input" type="checkbox" role="switch" id="{{ $elementId }}"
                   @if ($onChange) onchange="{{ $onChange }}" @endif
                   name="{{ $elementName }}"
                   value="1" @if ($value ?? false) checked @endif
            >
            <label id="label_{{ $elementId }}" for="{{ $elementId }}" aria-hidden="true">
                aus
            </label>
            <div id="label_screenreader_{{ $elementId }}" class="for-screenreader">{{$elementTitleText}}</div>
        </div>
    </div>
</div>
