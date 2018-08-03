@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="panel-heading"></div>
                <div class="card-body">
                    <h5 class="card-title">
                        @lang('settings::app.email_notifications')
                    </h5>

                    {!! Form::open(['route' => 'settings.notifications.update', 'id' => 'notification-settings-form']) !!}

                    <div class="form-group my-4">
                        <div class="d-flex align-items-center">
                            <div class="switch">
                                <input type="checkbox"
                                       name="notifications_signup_email"
                                       class="switch"
                                       value="1"
                                       id="switch-signup-email"
                                    {{ setting('notifications_signup_email') ? 'checked' : '' }}>

                                <label for="switch-signup-email"></label>
                            </div>
                            <div class="ml-3 d-flex flex-column">
                                <label class="mb-0">@lang('app.sign_up_notification')</label>
                                <small class="pt-0 text-muted">
                                    @lang('settings::app.notify_admin_when_user_signs_up')
                                </small>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        @lang('settings::app.update_settings')
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
