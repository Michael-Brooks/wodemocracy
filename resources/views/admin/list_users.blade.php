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
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">verified</th>
                            <th scope="col">role</th>
                            <th scope="col">Email Subscription</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->verified }}</td>
                                <td>
                                    <form method="post" action="/admin/users/{{ $user->id }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" id="role" @if($user->id === 1) disabled @endif>
                                            @foreach($roles as $role)
                                                <option @if($user->hasRole($role->name)) selected @endif value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-success">Update User</button>
                                    </form>
                                </td>
                                <td>
                                    @switch(($user->subscription !== null) ? $user->subscription->subscription : 0)
                                        @case(0)
                                            Unsubscribed
                                            @break
                                        @case(1)
                                            Daily
                                            @break
                                        @case(2)
                                            Weekly
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <form method="post" action="/admin/users/{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete User</button>
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