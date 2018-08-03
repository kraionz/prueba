<div class="card">
    <div class="card-body">
        <h5 class="card-title">@lang('settings::app.authentication_throttling')</h5>


        <form method="POST" action="{{ route('admin.settings.general.update') }}" id="auth-throttle-settings-form">
            @csrf
        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <label class="custom-switch">
                    @include('settings::includes.checkbox', ['setting' => 'throttle_enabled'])
                 <span class="custom-switch-indicator"></span>
                </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('settings::app.throttle_authentication')</label>
                    <small class="text-muted">
                        @lang('settings::app.should_the_system_throttle_authentication_requests')
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <label for="throttle_attempts">
                @lang('settings::app.maximum_number_of_attempts') <br>
                <small class="text-muted">@lang('settings::app.max_number_of_incorrect_login_attempts')</small>
            </label>
            <input type="text" name="throttle_attempts" class="form-control"
                   value="{{ setting('throttle_attempts', 10) }}">
        </div>

        <div class="form-group my-4">
            <label for="throttle_lockout_time">
                @lang('settings::app.lockout_time') <br>
                <small class="text-muted">@lang('settings::app.num_of_minutes_to_lock_the_user')</small>
            </label>
            <input type="text" name="throttle_lockout_time" class="form-control"
                   value="{{ setting('throttle_lockout_time', 1) }}">
        </div>

        <button type="submit" class="btn btn-primary float-right">
            @lang('settings::app.update_settings')
        </button>

        </form>
    </div>
</div>
