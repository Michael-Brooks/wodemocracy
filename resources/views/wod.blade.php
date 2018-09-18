@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(empty($wod))
                <div class="col-12 bg-white p-5 text-center">
                    <h2>This wod hasn't been created yet, please try again later.</h2>
                </div>
            @else
                <div class="col-12 pt-3 pb-3">
                    <div class="card">
                        <h5 class="card-header">
                            @if($wod->workout_date === \Carbon\Carbon::parse(Carbon\Carbon::tomorrow())->format('Y-m-d'))
                                Submit your workout and VOTE NOW
                            @else
                                View workout history
                                for {{ \Carbon\Carbon::parse($wod->workout_date)->format('d/m/Y') }}
                            @endif
                        </h5>
                    </div>
                </div>
            </div>

            @auth
                @if($wod->workout_date === \Carbon\Carbon::parse(Carbon\Carbon::tomorrow())->format('Y-m-d'))
                    <div class="row">
                        <div class="col-12 pt-3 pb-3">
                            <div class="card">
                                @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <form action="/workout/{{ $wod->id }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control"
                                                   placeholder="AMRAP, EMOM, EOMOM, For Time. - Duration" required>

                                            @if ($errors->has('title'))
                                                <span style="display: inherit" class="invalid-feedback">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <textarea name="details" class="form-control" rows="5" placeholder="WOD details"
                                                      required></textarea>
                                            @if ($errors->has('details'))
                                                <span style="display: inherit" class="invalid-feedback">
                                                        <strong>{{ $errors->first('details') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                        <button class="btn btn-success btn-block">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            <wod :id="{{ $id }}" :auth="{{ Auth::check() ?: 0 }}" :user="{{ Auth::id() ?: 0 }}"></wod>
        @endif
    </div>
@endsection