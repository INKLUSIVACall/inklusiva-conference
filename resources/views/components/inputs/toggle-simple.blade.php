@props([
    'elementId' => '',
    'elementName' => '',
    'elementLabel' => '',
    'elementValue' => '',
    'value' => '',
    'class' => '',
    'innerClass' => '',
    'customCheckedState' => false,
    'checked' => false,
])
<div class="component component-form-element component-form-element-toggle-and-label {{ $class }}">
    <div class="element-values">
        <div class="form-check form-switch">
            <input aria-labelledby="label_{{ $elementId }}" class="form-check-input {{ $innerClass }}" type="checkbox"
                role="switch" id="{{ $elementId }}" name="{{ $elementName }}"
            @if (!$customCheckedState) value="1" @if ($value ?? false) checked @endif @else
                value="{{ $elementValue }}" @if ($checked) checked @endif @endif
            @error($elementName)
                aria-invalid="true"
                aria-errormessage="err{{ $elementName }}"
            @enderror
            >
            <label id="label_{{ $elementId }}" for="{{ $elementId }}"
                aria-hidden="true">{!! $elementLabel !!}</label>
        </div>
        @error($elementName)
            <div class="message message-type-text error" role="alert">
                <div class="title" id="err{{ $elementName }}">{{ $message }}</div>
            </div>
        @enderror
    </div>
</div>
