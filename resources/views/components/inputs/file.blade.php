@props( [
'elementTitleText' => '',
'elementTitleBook' => '',
'elementTitleSmall' => '',
'elementAsLabel' => '',
'elementIcon' => '',
'elementDesc' => '',
'elementId' => '',
'elementName' => '',
'hidden' => '',
'accept' => '',
])
<div class="component component-form-element form-file" id="component_{{ $elementId }}" @if($hidden) hidden @endif>
    <x-inputs.component-generate-form-element-title-desc
        elementAsLabel="{{$elementAsLabel}}"
        elementTitleText="{{$elementTitleText}}"
        elementTitleBook="{{$elementTitleBook}}"
        elementTitleSmall="{{$elementTitleSmall}}"
        elementIcon="{{$elementIcon}}"
        elementDesc="{!!$elementDesc !!}"
        elementId="{{$elementId}}"
    />

    <div class="element-values">
        <input type="file" id="{{ $elementId }}" name="{{ $elementName }}" accept="{{ $accept }}">
        @error($elementName)
            <div class="message message-type-text error" role="alert">
                <div class="title">{{ $message }}</div>
            </div>
        @enderror
    </div>
</div>
