<div class="component component-element">
    @if(isset($iconBig)) <div class="component component-icon">
        <i class="{{ $iconBig }}"></i>
    </div>
    @endif
    <div class="component component-content">
        <div class="component component-content-redaktion">
            @if(isset($iconSmall)) <div class="component component-element-headline-icon">
                <i class="{{ $iconSmall }}"></i>
            </div>
            @endif
            <div class="component component-element-headline">
                @if(isset($headline)) {{ $headline }} @endif
            </div>
            <div class="component component-element-desc">
                @if(isset($description)) {{ $description }} @endif
            </div>
        </div>
        <div class="component component-content-input">
            {{ $slot }}
        </div>
    </div>
</div>
