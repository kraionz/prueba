@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.settings.general.update') }}" id="general-settings-form">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                @lang('settings::app.general')
                            </h5>

                            <div class="form-group">
                                <label for="name">@lang('settings::app.name')</label>
                                <input type="text" class="form-control" id="app_name"
                                       name="app_name" value="{{ setting('app_name') }}">
                            </div>
                            <div class="form-group">
                                <label class="custom-switch">
                                    @include('settings::includes.checkbox', ['setting' => 'manage_permissions'])
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ _('Manage Permissions') }}</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-switch">
                                    @include('settings::includes.checkbox', ['setting' => 'detect_admin_middleware'])
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ _('Detect Theme in Middleware for  Admin route ( Not work if include Middleware route [ theme:name ] or set theme )') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <button type="submit" class="btn btn-primary float-right">
            @lang('settings::app.update_settings')
        </button>

        </form>
    </div>
@endsection


