@extends('laralum::layouts.master')
@section('icon', 'mdi-account-settings-variant')
@section('title', trans('laralum_profile::profile.account_settings'))
@section('subtitle', trans('laralum_profile::profile.account_settings_desc'))
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3">
            <div class="card shadow">
                <div class="card-header">
                    @lang('laralum_profile::profile.edit_profile') ({{ $user->email }})
                </div>
                <div class="card-block">
                    <form method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <label for="profile_picture">@lang('laralum_profile::profile.profile_picture')</label>
                        <div class="row" id="profile_picture">
                            <div class="col-8">
                                <label class="custom-file">
                                    <input type="file" id="file" name="picture" value="{{ old('picture') }}" class="custom-file-input">
                                    <span class="custom-file-control"></span>
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="save_picture" id="save_picture" class="custom-control-input" @if(old('save_picture',$user->hasAvatar())) checked @endif>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">@lang('laralum_profile::profile.save_picture')</span>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="name">@lang('laralum::general.name')</label>
                            <input id="name" type="text" name="name" value="{{ old('name', isset($user->name) ? $user->name : '' ) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">@lang('laralum::general.password')</label>
                            <input id="password" type="password" name="password" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">@lang('laralum::general.password_confirmation')</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" value="" class="form-control">
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="current_password">@lang('laralum::general.current_password')</label>
                            <input id="current_password" type="password" name="current_password" value="" class="form-control">
                        </div>
                        <br />
                        <a href="#" class="btn btn-warning float-left">@lang('laralum::general.cancel')</a>
                        <button type="submit" class="btn btn-success float-right clickable">@lang('laralum::general.update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $('#file').click(function () {
                $('#save_picture').attr('checked', true);
            });
        });
    </script>
@endsection
