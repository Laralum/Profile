@extends('laralum::layouts.public')
@section('title', trans('laralum_profile::general.account_settings'))
@section('content')
                    @lang('laralum_profile::general.edit_profile') ({{ $user->email }})
                    <br><br>
                    <form method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <label for="picture">@lang('laralum_profile::general.profile_picture')</label>
                        <input type="file" id="file" name="picture" value="{{old('picture')}}" class="custom-file-input">
                        <br>
                        <input type="checkbox" name="save_picture" id="save_picture" class="custom-control-input" @if(old('save_picture',$user->hasAvatar())) checked @endif>
                        <span>@lang('laralum_profile::general.save_picture')</span>
                        <br>
                        <label for="name">@lang('laralum::general.name')</label>
                        <input id="name" type="text" name="name" value="{{ old('name', isset($user->name) ? $user->name : '' ) }}" class="form-control">
                        <br>
                        <label for="password">@lang('laralum::general.password')</label>
                        <input id="password" type="password" name="password" value="">
                        <br>
                        <label for="password_confirmation">@lang('laralum::general.password_confirmation')</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" value="">
                        <br>
                        <label for="current_password">@lang('laralum::general.current_password')</label>
                        <input id="current_password" type="password" name="current_password" value="">
                        <br>

                        <a href="#">@lang('laralum::general.cancel')</a>
                        <button type="submit" class="btn btn-success float-right clickable">@lang('laralum::general.update')</button>
                    </form>
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
