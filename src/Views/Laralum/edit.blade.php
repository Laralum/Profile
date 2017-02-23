@extends('laralum::layouts.master')
@section('icon', 'mdi-account-settings-variant')
@section('title', trans('laralum_profile::general.account_settings'))
@section('subtitle', trans('laralum_profile::general.account_settings_desc'))
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum_profile::general.edit_profile') ({{ $user->email }})
                    </div>
                    <div class="uk-card-body">
                        <form method="POST" class="uk-form-stacked" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <fieldset class="uk-fieldset">
                                {{md5(Auth::user()->mail)}}

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_profile::general.save_picture')</label>
                                        <input type="checkbox" name="save_picture" id="save_picture" class="uk-checkbox" @if(old('save_picture',$user->hasAvatar())) checked @endif>
                                            @lang('laralum_profile::general.save_picture')

                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_profile::general.profile_picture')</label>

                                        <div uk-form-custom="target: true">
                                            <input class="file" name="picture" type="file">
                                            <input class="uk-input uk-form-width-medium" type="text" placeholder="Browse files.." disabled>
                                        </div>
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_profile::general.name')</label>
                                    <input value="{{ old('name', $user->name) }}" name="name" class="uk-input" type="text" placeholder="@lang('laralum_profile::general.name')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_profile::general.password')</label>
                                    <input name="password" class="uk-input" type="password" placeholder="@lang('laralum_profile::general.password')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_profile::general.password_confirmation')</label>
                                    <input name="password_confirmation" class="uk-input" type="password" placeholder="@lang('laralum_profile::general.password_confirmation')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_profile::general.current_password')</label>
                                    <input name="current_password" class="uk-input" type="password" placeholder="@lang('laralum_profile::general.current_password')">
                                </div>

                                <div class="uk-margin">
                                    <a href="{{ route('laralum::profile.index') }}" class="uk-align-left uk-button uk-button-default">@lang('laralum_profile::general.cancel')</a>
                                    <button type="submit" class="uk-button uk-button-primary uk-align-right">
                                        <span class="ion-forward"></span>&nbsp; @lang('laralum_profile::general.submit')
                                    </button>
                                </div>



                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(function () {
            $('.file').click(function () {
                $('#save_picture').attr('checked', true);
            });
        });
    </script>
@endsection
