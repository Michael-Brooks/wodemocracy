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
                                for {{ \Carbon\Carbon::parse(Carbon\Carbon::tomorrow())->format('d/m/Y') }}
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

            @foreach($workouts as $workout)
                <div class="row mb-5">
                    <div class="col-12 pt-3 pb-3">
                        <div class="card">
                            <h5 class="card-header">{{ $workout->title }} - Created by {{ $workout->user->name }}</h5>
                            <div class="card-body">
                                @markdown($workout->details)
                            </div>
                            @auth
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <form action="/vote/{{ $workout->id }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="vote" value="1">
                                                    <button class="btn btn-block btn-info">
                                                        <i class="fas fa-arrow-circle-up"></i>
                                                        <span class="ml-2">{{ $workout->upvotes_count }}</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-1">
                                            <form action="/vote/{{ $workout->id }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="vote" value="-1">
                                                    <button class="btn btn-block btn-info">
                                                        <i class="fas fa-arrow-circle-down"></i>
                                                        <span class="ml-2">{{ $workout->downvotes_count }}</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        @if(\Illuminate\Support\Facades\Auth::id() === $workout->user_id)
                                            <div class="col-md-3 offset-md-7 col-sm-12">
                                                <form action="/workout/{{ $workout->id }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="form-group">
                                                        <button class="btn btn-block btn-danger">Delete Workout</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <button class="btn btn-block btn-info" disabled>
                                                <i class="fas fa-arrow-circle-up"></i>
                                                <span class="ml-2">{{ $workout->upvotes_count }}</span>
                                            </button>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-block btn-info" disabled>
                                                <i class="fas fa-arrow-circle-down"></i>
                                                <span class="ml-2">{{ $workout->downvotes_count }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
