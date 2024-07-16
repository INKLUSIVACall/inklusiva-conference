@props([
    'elementTitleText' => '',
    'elementTitleBook' => '',
    'elementTitleSmall' => '',
    'elementAsLabel' => '',
    'elementAsLegend' => '',
    'elementIcon' => '',
    'elementDesc' => '',
    'elementId' => '',
    'elementName' => '',
    'radioRow' => '',
    'noMarginBottom' => '',
    'options' => '',
    'selected' => '',
    'onChange' => '',
    'hiddenOptions' => [],
])
<div class="component component-form-element form-radio  @if ($noMarginBottom != '') no-margin-bottom @endif">
    <fieldset role="radiogroup" aria-labelledby="{{ $elementId }}_legend">
        <x-inputs.component-generate-form-element-title-desc elementAsLabel="{{ $elementAsLabel }}"
            elementAsLegend="{{ $elementAsLegend }}" elementTitleText="{{ $elementTitleText }}"
            elementTitleBook="{{ $elementTitleBook }}" elementTitleSmall="{{ $elementTitleSmall }}"
            elementIcon="{{ $elementIcon }}" elementDesc="{{ $elementDesc }}" elementId="{{ $elementId }}" />
        @error(str_replace(']', '', str_replace('[', '.', $elementName)))
            <div class="radio_error" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        <div class="element-values @if ($radioRow != '') as-row @endif">
            {{-- ACHTUNG: Da $options hier als Objekt genutzt wird, muss das Attribut per :options="..." gesetzt werden, ansonsten wird es als String übergeben und wirft hier einen Fehler.
                erwartetes Format :options=['value' => "Bezeichnung"] --}}
            @foreach ($options as $value => $optionLabel)
                <div class="radiobutton" @if (in_array($value, $hiddenOptions ?? [])) hidden @endif>
                    <div class="element">

                        <input @if (in_array($value, $hiddenOptions ?? [])) hidden @endif type="radio"
                            id="{{ $elementName }}_{{ $value }}"
                            onChange="{{ $onChange }}" name="{{ $elementName }}" value="{{ $value }}"
                            @if ($selected === '') {{ $loop->index === 0 ? 'checked' : '' }} @else {{ $value == $selected ? 'checked' : '' }} @endif>
                        <div class="radioicon">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <label @if (in_array($value, $hiddenOptions ?? [])) hidden @endif
                            for="{{ $elementName }}_{{ $value }}">{!! $optionLabel !!}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </fieldset>
</div>
