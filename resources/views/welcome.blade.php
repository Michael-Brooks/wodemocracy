@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!empty($tomorrowsWod))
            <div class="row">
                <div class="col-12 pt-3 pb-3">
                    <div class="card">
                        <h5 class="card-header"><a href="/wod/{{ $tomorrowsWod->id }}">Tomorrows WOD - VOTE NOW</a></h5>
                    </div>
                </div>
            </div>
        @endif

        @foreach($wods as $wod)
            <div class="row">
                <div class="col-12 pt-3 pb-3">
                    @foreach($wod->workouts as $workout)
                        @if($workout->won === 1)
                            <div class="card">
                                <h5 class="card-header">WOD {{ Carbon\Carbon::parse($wod->workout_date)->format('d/m/Y') }}</h5>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $workout->title }}</h5>
                                    @markdown($workout->details)
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

        {{ $wods->links() }}
    </div>
@endsection
