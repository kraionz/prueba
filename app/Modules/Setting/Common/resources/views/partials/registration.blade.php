<div class="card">
    <div class="card-body">
        <h5 class="card-title">@lang('settings::app.registration')</h5>

        <form method="POST" action="{{ route('admin.settings.auth.update') }}" id="registration-settings-form">
            @csrf

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <label class="custom-switch">
                    @include('settings::includes.checkbox', ['setting' => 'reg_enabled'])

                    <span class="custom-switch-indicator"></span>
                </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('settings::app.allow_registration')</label>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <label class="custom-switch">
                    @include('settings::includes.checkbox', ['setting' => 'tos'])
                    <span class="custom-switch-indicator"></span>
                </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('settings::app.terms_and_conditions')</label>
                    <small class="pt-0 text-muted">
                        @lang('settings::app.the_user_has_to_confirm')
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                <label class="custom-switch">
                    @include('settings::includes.checkbox', ['setting' => 'reg_email_confirmation'])
                <span class="custom-switch-indicator"></span>
                </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('settings::app.email_confirmation')</label>
                    <small class="text-muted">
                        @lang('settings::app.require_email_confirmation')
                    </small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary float-right">
            @lang('settings::app.update_settings')
        </button>

    </div>
</div>
