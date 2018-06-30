@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('dashboard') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"
                                       for="name">{{ __('Full Name') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="name" type="text" value="{{ $user->name }}"
                                           required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: inherit;">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"
                                       for="email">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="email" type="text" value="{{ $user->email }}"
                                           required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: inherit;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_update" class="col-md-4 col-form-label text-md-right">
                                    Subscribe to E-Mail Updates
                                </label>
                                <div class="col-md-1 text-md-center mt-2">
                                    <input class="form-check-input" type="checkbox" name="email_update" id="email_update" @if($user->email_update === 1) checked @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newsletter" class="col-md-4 col-form-label text-md-right">Subscribe to
                                    Newsletter E-Mail</label>
                                <div class="col-md-1 text-md-center mt-2">
                                    <input name="newsletter" id="newsletter" class="form-check-input" type="checkbox"
                                           @if($user->subscription !== null && $user->subscription->subscription === 1) checked @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Update Account') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('dashboard') }}" id="delete_form">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <confirm-delete-button title="{{ __('Delete User') }}" message="Are you sure? Your account will not be recoverable."></confirm-delete-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
