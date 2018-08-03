@extends('layouts.app')

@push('styles')
    <style>

    </style>
 @endpush

@section('content')
    <div class="container">

        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-center w-1"><i class="icon-people"></i></th>
                            <th>Module</th>
                            <th class="text-center">Payment</th>
                            <th>Activity</th>
                            <th class="text-center">Satisfaction</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modules as $module)
                        <tr>
                            <td class="text-center">
                                <div class="avatar d-block" style="background-image: url(https://tabler.github.io/tabler/demo/products/apple-iphone7.jpg)">
                                    <span class="avatar-status bg-green"></span>
                                </div>
                            </td>
                            <td>
                                <div>{{ $module->get('name') }}</div>
                                <div class="small text-muted">
                                    @if($module->get('version')){{ 'version ' . $module->get('version') }}@endif
                                </div>
                            </td>

                            <td class="text-center">
                                <i class="payment payment-visa"></i>
                            </td>
                            <td>
                                <div class="small text-muted">Last login</div>
                                <div>4 minutes ago</div>
                            </td>
                            <td class="text-center">
                                <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42" data-thickness="3" data-color="blue"><canvas width="40" height="40"></canvas>
                                    <div class="chart-circle-value">42%</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
