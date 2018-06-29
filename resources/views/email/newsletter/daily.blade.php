@component('mail::message')
## Hello {{ $name }},

### Take a look and smash out today's WOD!

@foreach($wod->workouts as $workout)
@if($workout->won === 1)
@component('mail::panel')
# {{ $workout->title }}
{{ $workout->details }}
@endcomponent
@endif
@endforeach

## Want to see your workout here?
## Visit https://wodemocracy.com to submit your own!

Thank you,<br>
Michael Brooks.


@endcomponent