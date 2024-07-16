@props( [
'linkName' => '',
'linkHref' => '',
'linkIcon' => 'fa-solid fa-arrow-right',
'linkInvert' => '',
'linkId' => '',
'linkTarget' => '_self',
])
<a href="{{$linkHref}}" aria-labelledby="{{ $linkId }}_label" id="{{$linkId}}" target="{{$linkTarget}}" class="component-textlink @if ($linkInvert!='') invert @endif">
    <div class="icon">
        <i class="{{$linkIcon}}"></i>
    </div><span id="{{ $linkId }}_label" class="title">{{$linkName}}</span>
</a>
