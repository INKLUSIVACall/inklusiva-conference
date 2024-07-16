@props([
    'messageType' => 'error',
    'messages' => null,
    'messageTitle' => 'Leider ist ein Fehler aufgetreten.',
    'messageTitlePlural' => 'Leider sind Fehler aufgetreten.',
    'embedded' => false,
])

@php
    if (is_string($messages)) {
        $messages = [$messages];
    } else {
        $messages = $messages->toArray();
    }
@endphp

@if (count($messages) > 0)
    <div class="@if (!$embedded) mt-3 @else mb-5 @endif message message-type-box {{ $messageType }}"
        @if ($messageType === 'error') role="alert" @else role="status" @endif>
        @if (!$embedded)
            <div class="container">
                <div class="col-12">
        @endif
        <div class="message-area" tabindex="0">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <div class="message-icon">
                        <div class="icon">
                            @if ($messageType == 'error')
                                <i class="fa-solid fa-xmark"></i>
                            @else
                                <i class="fa-solid fa-check"></i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="title">
                        @if (count($messages) == 1)
                            {{ $messageTitle }}
                        @else
                            {{ $messageTitlePlural }}
                        @endif
                    </div>
                    <div class="desc">
                        @if ($messageType == 'error')
                            <ul>
                                @foreach ($messages as $fieldNameMessages)
                                    @foreach ($fieldNameMessages as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        @endif
                        @if ($messageType == 'success')
                            {{ $messages[0] }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if (!$embedded)
    </div>
    </div>
@endif
</div>
<script>
    @if ($messageType === 'error')
        document.querySelectorAll('[role=alert] .message-area')[0].focus()
    @else
        document.querySelectorAll('[role=status] .message-area')[0].focus()
    @endif
</script>

@section('pagetitle')
    {{ $messageTitle }} - @yield('pagetitle')
@overwrite
@endif
