@extends('layouts.app')

@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.theme.update', $theme->get('theme')) }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ _('Edit') }} {{ $theme->get('name') }}
                            </h5>

                            <div class="row pb-4">
                                <div class="col-auto">
                                   <img src="{{ ( '/themes/'.$theme->get('theme').'/assets/img/'.$theme->get('logo')) }}" style="width: 220px">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-label">Change Logo</div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $theme->get('name')) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="hidden" value="0" name="admin">
                                    <input name="admin" type="checkbox"  class="custom-switch-input" value="1" {{ $theme->get('admin') ? 'checked' : '' }} >
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ _('Admin') }}</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="hidden" value="0" name="active">
                                    <input name="active" type="checkbox"  class="custom-switch-input" value="1" {{ $theme->get('active') ? 'checked' : '' }} >
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ _('Active') }}</span>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-icon btn-primary"><i class="fe fe-check"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


