@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Details</th>
                        <th scope="col">Won</th>
                        <th scope="col">Moderated Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workouts as $workout)
                        <tr>
                            <th scope="row">{{ $workout->id }}</th>
                            <td>{{ $workout->title }}</td>
                            <td>{{ $workout->details }}</td>
                            <td>{{ $workout->won }}</td>
                            <td>{{ $workout->moderated_at }}</td>
                            <td>{{ $workout->status }}</td>
                            <td>
                                <form method="post" action="/admin/workouts/{{ $workout->id }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" id="status">
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Rejected</option>
                                        <option value="3">Postponed</option>
                                    </select>
                                    <button class="btn btn-success">Update Workout</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="/admin/workouts/{{ $workout->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete Workout</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection