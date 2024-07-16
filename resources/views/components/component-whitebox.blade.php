@props( [
'ariaLabel' => '',
'format' => '',
'title' => '',
'class' => '',
])
<section role="contentinfo" @if(isset($ariaLabel)) aria-label="{{ $ariaLabel }}"
         @endif class="component component-whitebox {{$class}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="whitebox-title">
                    <x-component-generate-title title="{{$title}}" format="{{$format}}"/>
                </div>
                <div class="whitebox">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</section>
