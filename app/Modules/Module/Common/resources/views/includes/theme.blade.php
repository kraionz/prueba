<div class="card">
    @if($theme->get('active'))
        <div class="card-status card-status-left bg-success"></div>
    @endif

    <img src="https://tabler.github.io/tabler/demo/photos/jonatan-pie-226191-500.jpg" alt="Photo by Alice Mason" class="card-img-top">

    <div class="p-3 d-flex align-items-center px-2">
        <div>
            <div>{{ $theme->get('name') }}</div>
            <small class="d-block text-muted">@if($theme->get('version')){{ 'version ' . $theme->get('version') }}@endif</small>
        </div>
        <div class="ml-auto text-muted">
            <div class="btn-list">
                @if($theme->get('admin'))
                    <button type="button" class="btn btn-icon btn-primary btn-purple" data-toggle="tooltip" data-placement="top" title="Admin"><i class="fe fe-bar-chart"></i></button>
                @endif
                <button type="button"
                        class="btn btn-icon btn-primary btn-secondary"
                        onclick="window.location.href='{{ route('admin.theme.edit', $theme->get('theme')) }}'">
                    <i class="fe fe-git-merge"></i>
                </button>
                @if($theme->get('active'))
                    <button type="button" class="btn btn-icon btn-success"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Active">
                        <i class="fe fe-check"></i></button>
                @else
                        <form id="active-form_{{ $theme->get('name') }}" action="{{ route('admin.theme.active', $theme->get('theme')) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <button type="button" class="btn btn-icon btn-secondary"
                                data-toggle="tooltip"
                                data-placement="top"
                                onclick="event.preventDefault(); document.getElementById('active-form_{{ $theme->get('name') }}').submit();"
                                title="Activate Theme"><i class="fe fe-check"></i></button>
                @endif

            </div>
        </div>
    </div>
</div>
