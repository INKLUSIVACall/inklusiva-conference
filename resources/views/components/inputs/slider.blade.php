@props( [
'elementTitleText' => '',
'elementTitleBook' => '',
'elementTitleSmall' => '',
'elementAsLabel' => '',
'elementAsLegend' => '',
'elementIcon' => '',
'elementDesc' => '',
'elementId' => '',
'elementName' => '',
'min' => '',
'max' => '',
'step' => '',
'value' => '',
'unit' => '',
'oninput' => '',
'possibleValues' => [],
'decimalSlider' => false,
])
<div class="component component-form-element form-slider">

    <x-inputs.component-generate-form-element-title-desc
        elementAsLabel="{{$elementAsLabel}}"
        elementAsLegend="{{$elementAsLegend}}"
        elementTitleText="{{$elementTitleText}}"
        elementTitleBook="{{$elementTitleBook}}"
        elementTitleSmall="{{$elementTitleSmall}}"
        elementIcon="{{$elementIcon}}"
        elementDesc="{{$elementDesc}}"
        elementId="{{$elementId}}"
    />
    @if($possibleValues === [])
    <div class="element-values">
        <div class="slider">
        <input
            type="range"
            role="slider"
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step ?? 1 }}"
            value="{{ $value ?? ceil($max / 2) }}"
            id="{{ $elementId }}"
            name="{{ $elementName }}"
            oninput="Slider.onInput(this, {{json_encode($decimalSlider) }}, '{{ $unit ?? '' }}');{{ $oninput ?? '' }}"
            data-span-id="{{ $elementId }}_value" >
        </div>
        <div class="value" id="{{ $elementId }}_value" aria-hidden="true" aria-labelledby="{{ $elementId }}_label">
            @if($decimalSlider)
                {{ $value * 100 ?? ceil($max / 2) * 100 }} {{ $unit ?? '' }}
            @else
                {{ $value ?? ceil($max / 2) }} {{ $unit ?? '' }}
            @endif
        </div>
    </div>
    {{$slot}}
    @else
    <div class="element-values">
        <div class="slider">
        <input
            type="range"
            role="slider"
            min="0"
            max="{{ count($possibleValues) - 1 }}"
            step="1"
            value="{{ $value ?? ceil(count($possibleValues) - 1 / 2) }}"
            id="{{ $elementId }}"
            name="{{ $elementName }}"
            oninput="Slider.onInputWithValues(this, '{{ json_encode($possibleValues) }}'); {{ $oninput ?? '' }}"
            data-span-id="{{ $elementId }}_value"
            aria-valuetext="{{ $possibleValues[$value ?? ceil(count($possibleValues) - 1 / 2)] }}"
        >
        </div>
        <div class="value" id="{{ $elementId }}_value" aria-hidden="true" aria-labelledby="{{ $elementId }}_label">
            {{ $possibleValues[$value ?? ceil(count($possibleValues) - 1 / 2)] }}
        </div>
    </div>
    {{$slot}}
    @endif
</div>

