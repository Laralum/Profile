@extends('laralum::layouts.master')
@section('icon', 'mdi-account')
@section('title', trans('laralum_profile::general.profile'))
@section('subtitle', trans('laralum_profile::general.profile_desc'))
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum_profile::general.profile')
                    </div>
                    <div class="uk-card-body">
                        <center>
                            <div class="uk-text-center">
                                <div class="uk-inline-clip uk-transition-toggle">
                                    <img  src="{{ $user->avatar() }}" class="uk-border-circle" style="max-width=150px;max-height:150px" alt="">
                                    <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
                                        <a href="{{ route('laralum::profile.edit') }}" class="uk-button uk-button-default">@lang('laralum::general.edit')</a>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <p class="uk-text-lead">{{ $user->name }}</p>
                            <p class="uk-text-meta">{{ $user->email }}</p>
                            <br><br>
                            <a href="{{ route('laralum::profile.edit') }}" class="uk-button uk-button-default">@lang('laralum::general.edit')</a>
                        </center>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        </div>
    </div>
@endsection
