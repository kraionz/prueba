<div class="col-md-3">
    <div class="card">
        <div class="list-group list-group-transparent mb-0">
            <div class="pb-1">
                <a href="{{ route('settings.account') }}"
                   class="list-group-item list-group-item-action d-flex align-items-center {{ is_active_route('settings.account') }}">
                    <span class="icon mr-3"><i class="fe fe-user"></i></span>{{ lang('Edit Profile') }}
                </a>
                <a href="{{ route('settings.preferences') }}"
                   class="list-group-item list-group-item-action d-flex align-items-center {{ is_active_route('settings.preferences') }}">
                    <span class="icon mr-3"><i class="fe fe-send"></i></span>{{ lang('Preferences') }}
                </a>
                <a href="{{ route('settings.password') }}"
                   class="list-group-item list-group-item-action d-flex align-items-center {{ is_active_route('settings.password') }}">
                    <span class="icon mr-3"><i class="fe fe-alert-circle"></i></span>{{ lang('Password') }}
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fe fe-star"></i></span>{{ lang('Notifications') }}
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fe fe-file"></i></span>{{ lang('Edit Profile') }}
                </a>
            </div>
            <div class="border-top pt-1 pb-1">
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fe fe-tag"></i></span>{{ lang('Orders') }}
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>{{ lang('payments') }}
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>{{ lang('Shipping') }}
                </a>

            </div>
            <div class="border-top pt-1">
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>{{ lang('Credits & Referral') }}
                </a>
            </div>

        </div>
    </div>
</div>
