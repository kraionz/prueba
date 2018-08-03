@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @include('settings::partials.auth')
            </div>
            <div class="col-md-12">
                @include('settings::partials.throttling')
            </div>
            <div class="col-md-12">
                @include('settings::partials.registration')
            </div>
        </div>

    </div>
@endsection


