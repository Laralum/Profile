@extends('laralum::layouts.public')
@section('title', trans('laralum_profile::profile.profile'))
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3">
            <div class="card shadow">
                <div class="card-block">
                        {!! csrf_field() !!}
                        <center>
                            <img src="{{ $user->avatar() }}" class="rounded-circle" alt="@lang('laralum_profile::profile.profile_picture')" style="max-width=100px;max-height:100px">
                            <br><br>
                            <p style="font-size:20px;">{{ $user->name }}</p>
                            <p class="text-muted">{{ $user->email }}</p>
                            <br><br>
                            <a href="{{ route('laralum_public::profile.edit') }}" class="btn btn-info">@lang('laralum::general.edit')</a>
                        </center>
                </div>
            </div>
        </div>
    </div>
@endsection
