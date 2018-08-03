@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           @include('user.settings.includes.sidebar')
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ lang('Edit Profile') }}</div>
                    <form method="POST" action="{{ route('settings.account.update') }}">
                        @csrf @method('PUT')

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="row justify-content-lg-start">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-control-plaintext">Profile</div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="form-label">{{ lang('First Name') }}</label>
                                        <input id="first_name"
                                               type="text"
                                               class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                               name="first_name"
                                               value="{{ old('first_name', $user->profile->first_name) }}"
                                               placeholder="{{ lang('First Name') }}">

                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name" class="form-label">{{ lang('Last Name') }}</label>
                                        <input id="last_name"
                                               type="text"
                                               class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                               name="last_name"
                                               value="{{ old('last_name', $user->profile->last_name) }}"
                                               placeholder="{{ lang('Last Name') }}">

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="username" class="form-label">{{ lang('Username') }}</label>
                                        <input id="username"
                                               type="text"
                                               class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                               name="username"
                                               value="{{  old('username', $user->username) }}"
                                               placeholder="{{ lang('Username') }}" required>

                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">{{ lang('Bio') }}</label>
                                        <textarea name="description" class="form-control" rows="5" placeholder="{{ lang('Describe yourself here...') }}">{{ old('description', $user->profile->description) }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-lg-start">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-control-plaintext">Account</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                        <label for="email" class="form-label">{{ lang('Email') }}</label>
                                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Date of birth</label>
                                        <div class="row gutters-xs">
                                            <div class="col-5">
                                                <select name="birth[month]" class="form-control custom-select">
                                                    <option value="">Month</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option selected="selected" value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <select name="birth[day]" class="form-control custom-select">
                                                    <option value="">Day</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option selected="selected" value="20">20</option>
                                                    <option value="21">21</option>

                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select name="birth[year]" class="form-control custom-select">
                                                    <option value="">Year</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2013">2013</option>
                                                    <option selected="selected" value="1989">1989</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">{{ lang('Genre') }} </div>
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="gender" value="male"
                                                    {{ old('gender', $user->profile->gender)  == 'male' ? 'checked' : '' }}>
                                                <span class="custom-control-label">{{ lang('Male') }}</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="gender" value="female"
                                                    {{ old('gender', $user->profile->gender)  == 'female' ? 'checked' : '' }}>
                                                <span class="custom-control-label">{{ lang('Female') }}</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="gender" value="unspecified"
                                                    {{ old('gender', $user->profile->gender) == 'unspecified' ? 'checked' : '' }}>
                                                <span class="custom-control-label">{{ lang('Unspecified') }}</span>
                                            </label>
                                        </div>
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
