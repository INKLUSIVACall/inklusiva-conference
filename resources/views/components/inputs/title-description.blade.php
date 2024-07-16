@props( [
'elementTitleText' => '',
'elementTitleBook' => '',
'elementTitleSmall' => '',
'elementIcon' => '',
'elementDesc' => '',
])
<div class="component component-form-element component-form-title-desc">
    <x-inputs.component-generate-form-element-title-desc
        elementTitleText="{{$elementTitleText}}"
        elementTitleBook="{{$elementTitleBook}}"
        elementTitleSmall="{{$elementTitleSmall}}"
        elementIcon="{{$elementIcon}}"
        elementDesc="{{$elementDesc}}"
    />
</div>

