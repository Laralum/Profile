@extends('laralum::layouts.public')
@section('title', trans('laralum_profile::profile.account_settings'))
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3">
            <div class="card shadow">
                <div class="card-block">
                    <form method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @php
                            $user = Laralum\Users\Models\User::findOrFail(Auth::id());
                            $fields = ['name' => 'text', 'password' => 'password', 'password_confirmation' => 'password', 'current_password' => 'password'];
                        @endphp
                        <label for="profile_picture">@lang('laralum_profile::profile.profile_picture')</label>
                        <div class="row" id="profile_picture">
                            <div class="col-8">
                                <label class="custom-file">
                                    <input type="file" id="file" name="picture" value="{{old('picture')}}" class="custom-file-input">
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
                        @foreach ($fields as $field => $type)
                            <div class="form-group">
                                <label for="{{ $field }}">@lang('laralum::general.'.$field)</label>
                                <input type="{{ $type }}" name="{{ $field }}" value="@if($type != 'password'){{ old($field, isset($user->$field) ? $user->$field : '' ) }}@endif" class="form-control" id="{{ $field }}">
                            </div>
                        @endforeach
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
