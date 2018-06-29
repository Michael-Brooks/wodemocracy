@component('mail::message')
## Hello {{ $name }},

### Take a look at and smash out this week's WODs

@foreach($wods as $wod)
##### WOD {{ Carbon\Carbon::parse($wod->workout_date)->format('d/m/Y') }}
# {{ $wod->title }}
{{ $wod->details }}
@endforeach

Thank you,<br>
{{ config('app.name') }}
@endcomponent