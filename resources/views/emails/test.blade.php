@component('mail::message')
# Test Email

{{ $content }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
