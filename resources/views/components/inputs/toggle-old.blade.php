<div class="form-check form-switch toggle @if(isset($fixedLabel)) toggle-fixed-label @endif" style="padding-left: 0 !important">
    @if (isset($inputIcon))
        <i class="{{ $inputIcon }}"></i>
    @endif
    @if (isset($label))
        <div id="toggleLabel_{{ $id }}" class="form-check-label" aria-hidden="true">{{ $label }}</div>
    @endif
    @if (isset($inputHeadline))
        <b>{{ $inputHeadline }}</b>
    @endif

        @error(str_replace(']', '', str_replace('[', '.', $name)))
        <div class="message" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror

    <input type="hidden" name="{{ $name }}" value="0">
    <input style="margin-left: 0 !important; margin-right:0.5rem"
        @if (isset($fixedLabel)) aria-labelledby="toggleState_{{ $id }}" @else aria-labelledby="toggleLabel_{{ $id }}" @endif
        @if (isset($inputDescription)) aria-describedby="{{ $name }}_description" @endif
        class="form-check-input" type="checkbox" role="switch" id="{{ $id }}" name="{{ $name }}"
        value="1" @if ($attributes['value']) checked @endif
    >
    <span style="cursor:pointer" id="toggleState_{{ $id }}" aria-hidden="true"
        onclick="Toggle.onClick({{ $id }})">
        @if (isset($fixedLabel))
            {{ $fixedLabel }}
        @else
            aus
        @endif
    </span>
    @if (isset($inputDescription))
        <div aria-hidden="true" id="{{ $name }}_description">{{ $inputDescription }} </div>
    @endif
</div>
