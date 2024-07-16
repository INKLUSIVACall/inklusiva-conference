@props([
    'label' => '',
    'id' => '',
    'name' => '',
    'value' => '',
    'options' => [],
    'noMarginBottom' => '',
])
<div class="component-form-element @if ($noMarginBottom != '') no-margin-bottom @endif">
    <div class="element-title-desc">
        <div class="element-title">
            <div class="title small">
                <legend for="{{ $id }}">{{ $label }}</legend>
            </div>
        </div>
    </div>
    <div class="component-select-element as-language" data-type="component">
        <select name="{{ $name }}" id="{{ $id }}" aria-label="{{ $label }}"
            class="component component-select" data-type="component">
            @foreach ($options as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" @if ($value === $optionKey) selected="selected" @endif>
                    {{ $optionValue }}</option>
            @endforeach
        </select>
    </div>
</div>
