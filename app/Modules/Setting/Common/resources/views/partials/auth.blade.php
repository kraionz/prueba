<div class="card">
    <div class="card-body">

        <h5 class="card-title">
            @lang('settings::app.authentication')
        </h5>

        <form method="POST" action="{{ route('admin.settings.auth.update') }}" id="auth-general-settings-form">
            @csrf

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <label class="custom-switch">
                    @include('settings::includes.checkbox', ['setting' => 'remember_me'])
                    <span class="custom-switch-indicator"></span>
                </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('settings::app.allow_remember_me')</label>
                    <small class="pt-0 text-muted">
                        @lang('settings::app.should_remember_me_be_displayed')
                    </small>
                </div>
            </div>
        </div>
        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <label class="custom-switch">
                    @include('settings::includes.checkbox', ['setting' => 'forgot_password'])
                    <span class="custom-switch-indicator"></span>
                </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('settings::app.forgot_password')</label>
                    <small class="pt-0 text-muted">
                        @lang('settings::app.enable_disable_forgot_password')
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <label for="login_reset_token_lifetime">
                @lang('settings::app.reset_token_lifetime') <br>
                <small class="text-muted">@lang('settings::app.number_of_minutes')</small>
            </label>
            <input type="text" name="login_reset_token_lifetime"
                   class="form-control" value="{{ setting('login_reset_token_lifetime', 30) }}">
        </div>

        <button type="submit" class="btn btn-primary float-right">
            @lang('settings::app.update_settings')
        </button>

        </form>
    </div>
</div>
