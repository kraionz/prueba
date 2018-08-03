@extends('layouts.auth')

@section('content')
    <form class="card" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
        <div class="card-body p-6">
            <div class="card-title">{{ __('Register') }}</div>
            <div class="form-group">
                <label for="username" class="form-label">{{ __('Username') }}</label>
                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}"  placeholder="Username" required autofocus>
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">{{ __('E-Mail Address') }}</label>
                <input type="email"  name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"  placeholder="{{_('Enter email') }}" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
            </div>

            @if (setting('tos'))
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="tos" id="tos" value="1"/>
                        <label class="custom-control-label" for="tos">
                            @lang('bases::app.i_accept')
                            <a href="#" data-toggle="modal">@lang('bases::app.terms_of_service')</a>
                        </label>
                    </div>
                </div>
            @endif

            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
            </div>
        </div>
    </form>
@endsection
