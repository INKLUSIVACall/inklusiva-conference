<div class="component component-form-element component-datacollection">
    <section role="contentinfo" aria-label="{{ $headline }}">
        @if ($headline!='')
        <x-inputs.component-generate-form-element-title-desc
            elementTitleText="{{ $headline }}"
            elementTitleSmall="true"
            elementId="{{$id}}"
        />
        @endif
        <div class="element-values @if ($headline=='') no-headline @endif">
            @if (isset($content))
                @foreach($content as $key => $value)
                    <x-component-datacollection-item
                        icon="{{$value['icon'] ?? ''}}"
                        title="{{ $key }}"
                        value="{{ $value['value'] ?? '' }}"
                        ariaLabelForTitle="{{ $value['ariaLabelForTitle'] ?? '' }}"
                    />
                @endforeach
            @endif
            {{ $slot }}
        </div>
    </section>
</div>
