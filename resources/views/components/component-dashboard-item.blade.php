@props( [
'ariaLabel' => '',
'title' => '',
'icon' => '',
'desc' => '',
'descId' => '',
'desc2' => '',
'desc2Id' => '',
'hasProfileStatusField' => false,
])
<section role="contentinfo" @if(isset($ariaLabel)) aria-label="{{ $ariaLabel }}" @endif class="component component-dashboard-item">
    <div class="box">
        <div class="headline">
            <div class="icon">
                <i class="{{$icon}}"></i>
            </div>
            <div class="title">{{$title}}</div>
        </div>
        <div class="desc" id="{{ $descId }}">
            {{ $desc }}
        </div>
        @if($hasProfileStatusField)
        <div class="desc" id="meetingProfileStatus">
            {{ __('backend/dashboard.profile.profileStatusNegative') }}
        </div>
        @endif
        <div class="buttons">
            {{ $slot }}
        </div>
    </div>
</section>
