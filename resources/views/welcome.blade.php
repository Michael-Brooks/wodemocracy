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

        <Wods></Wods>
    </div>
@endsection
