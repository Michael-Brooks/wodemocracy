@component('mail::message')
## Hello {{ $name }},

{{ $message }}

Thank you,<br>
{{ config('app.name') }}
@endcomponent