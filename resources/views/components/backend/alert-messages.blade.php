<div id="message-area" hx-get="{{route('base.rendermessage')}}" hx-trigger="render" hx-swap="outerHTML">
    @include('components.backend.alert-inline')
</div>
