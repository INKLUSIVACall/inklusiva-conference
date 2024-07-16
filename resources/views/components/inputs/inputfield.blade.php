@props([
    'elementTitleText' => '',
    'elementTitleBook' => '',
    'elementTitleSmall' => '',
    'elementAsLabel' => '',
    'elementIcon' => '',
    'elementDesc' => '',
    'elementId' => '',
    'elementName' => '',
    'elementType' => 'text',
    'elementPlaceholder' => '',
    'elementValue' => '',
    'elementRequired' => '',
    'elementAutofocus' => '',
    'elementAriaAutocomplete' => '',
    'noMarginBottom' => false,
    'allowSubmit' => false,
])
<div
    class="component component-form-element component-form-element-text @if ($noMarginBottom != '') no-margin-bottom @endif">
    <x-inputs.component-generate-form-element-title-desc elementAsLabel="{{ $elementAsLabel }}"
        elementTitleText="{{ $elementTitleText }}" elementTitleBook="{{ $elementTitleBook }}"
        elementTitleSmall="{{ $elementTitleSmall }}" elementIcon="{{ $elementIcon }}" elementDesc="{{ $elementDesc }}"
        elementId="{{ $elementId }}"/>

    <div class="element-values">
        <div style="position: relative">
            <input type="{{ $elementType }}" id="{{ $elementId }}" name="{{ $elementName }}"
                @if ($elementRequired != '') required @endif placeholder="{{ $elementPlaceholder }}"
                value="{{ $elementValue }}"
                @if ($allowSubmit === false) onkeydown="return (event.keyCode!=13);" @endif
                @if ($elementRequired != '') required @endif @if ($elementAutofocus != '') autofocus @endif
                @if ($elementAriaAutocomplete != '') aria-autocomplete="{{ $elementAriaAutocomplete }}" @endif>

            @if ($elementType == 'password')
                <i class="fas fa-eye password-eye" onclick="togglePassword{{ $elementId }}()"></i>
                </i>
            @endif
        </div>

        @error($elementName)
            <div class="message message-type-text error @if ($noMarginBottom != '' && $noMarginBottom == true) mt-0 mb-4 @endif" role="alert">
                <div class="title">{{ $message }}</div>
            </div>
        @enderror

        {{ $slot }}
    </div>
</div>
<script>
    @if ($elementType == 'password')
        togglePassword{{ $elementId }} = () => {
            let input = document.getElementById('{{ $elementId }}');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    @endif
</script>
