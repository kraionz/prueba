@extends('layouts.app')

@push('styles')
    <style>

    </style>
 @endpush

@section('content')
    <div class="container">
        <div id="themes">
            <h3>Themes <span class="badge badge-secondary">Admin</span></h3>

                <div class="row ">
                    @foreach($themes as $theme)
                        @if($theme->get('admin'))
                            <div class="col-md-3">
                                @include('themes::includes.theme')
                            </div>
                        @endif
                    @endforeach
                </div>
            <h3>Themes <span class="badge badge-secondary">Site</span></h3>

            <div class="row">
                @foreach($themes as $theme)
                    @if(!$theme->get('admin'))
                        <div class="col-md-3">
                            @include('themes::includes.theme')
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
