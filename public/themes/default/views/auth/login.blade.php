@extends('layouts.auth')

@section('content')

    <form class="card" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
        <div class="card-body p-6">
            <div class="card-title">{{ __('Login') }}</div>
            <div class="form-group">
                <label for="username" class="form-label">{{ __('Username') }}</label>
                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}"  placeholder="Username or Email" required autofocus>
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">
                    Password
                    @if(setting('forgot_password'))
                        <a href="{{ route('password.request') }}" class="float-right small">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </label>
                <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            @if(setting('remember_me'))
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <span class="custom-control-label">{{ __('Remember Me') }}</span>
                    </label>
                </div>
            @endif
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
            </div>
        </div>
    </form>
    @if(setting('reg_enabled'))
        <div class="text-center text-muted">
            {{ _("Don't have account yet?") }} <a href="{{ route('register') }}">Sign up</a>
        </div>
    @endif

@endsection
