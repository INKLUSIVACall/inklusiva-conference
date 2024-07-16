@props([
    'helpLink' => null,
    'ariaLabel' => '',
    'desc' => '',
    'format' => '',
    'title' => '',
    'border' => '',
    'borderDotted' => '',
    'icon' => '',
    'showError' => false,
])
<section role="contentinfo" aria-label="{{ $ariaLabel }}"
    class="component component-descbox @if ($border != '') bordered @endif @if ($borderDotted != '') bordered-dotted @endif">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="descbox-content">
                    <div class="row">
                        <div class="col-12 @if (!$showError) col-lg-8 @endif">
                            <div class="title">
                                <x-component-generate-title title="{{ $title }}" format="{{ $format }}"
                                    :showError="$showError" icon="{{ $icon }}" />
                            </div>
                        </div>
                    </div>
                    @if ($showError === 'true')
                        <x-component-messages :messages=$errors :embedded="true" />
                    @endif
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="desc">
                                {!! $desc !!}
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            @if ($helpLink != null)
                                <div class="help-item">
                                    <x-component-help-button helpLink="{{ $helpLink }}" title="Hilfe öffnen" />
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($slot != '')
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="slot">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
