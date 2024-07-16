@props([
    'title' => '',
    'format' => '',
    'icon' => '',
    'showError' => false
])

@if ($icon != '')
    <i class="{{ $icon }}"></i>
@endif

@if ($title !== '')
    @if ($format === '')
        <h1>
        @else
            <{{ $format }}>
    @endif

    {{ $title }}

    @if ($format === '')
        </h1>
    @else
        </{{ $format }}>
    @endif

@endif
