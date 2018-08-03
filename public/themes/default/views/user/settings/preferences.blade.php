@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('user.settings.includes.sidebar')
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ lang('Change Password') }}</div>
                    <form method="POST" action="{{ route('settings.password.update') }}">
                        @csrf @method('PUT')
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="row justify-content-lg-start">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="form-label">{{ lang('Current password') }}</label>
                                            <input id="current_password"  type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" >

                                            @if ($errors->has('current_password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('current_password') }}</strong>
                                                </span>
                                            @endif

                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">{{ lang('New password') }}</label>
                                            <input id="password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password">

                                            @if ($errors->has('new_password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('new_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('new_password_confirmation') ? ' is-invalid' : '' }}">
                                            <label class="form-label">{{ lang('Confirm password') }}</label>
                                            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
