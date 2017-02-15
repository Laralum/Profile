@extends('laralum::layouts.public')
@section('title', trans('laralum_profile::profile.profile'))
@section('content')
    <img src="{{ $user->avatar() }}" alt="@lang('laralum_profile::profile.profile_picture')" style="max-width=100px;max-height:100px">
    <p style="font-size:20px;">{{ $user->name }}</p>
    <p>{{ $user->email }}</p>
    <a href="{{ route('laralum_public::profile.edit') }}">@lang('laralum::general.edit')</a>
@endsection
