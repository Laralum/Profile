@extends('laralum::layouts.master')
@section('title', 'Account settings')
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3">
            <div class="card shadow">
                <div class="card-block">
                    <form method="POST">
                        {!! csrf_field() !!}
                        @php
                            $fields = ['name' => 'text', 'password' => 'password', 'password_confirmation' => 'password', 'current_password' => 'password'];
                        @endphp
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="save_photo" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Save photo</span>
                        </label>
                        <label class="custom-file">
                            <input type="file" id="file" name="photo" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
                        @foreach ($fields as $field => $type)
                            <div class="form-group">
                                <label for="{{ $field }}">{{ str_replace('_', ' ', ucfirst($field)) }}</label>
                                <input type="{{ $type }}" name="{{ $field }}" value="@if($type != 'password'){{ old($field, isset($user->$field) ? $user->$field : '' ) }}@endif" class="form-control" id="{{ $field }}">
                                <strong class="text-danger">{{ $errors->first($field) }}</strong>
                            </div>
                        @endforeach
                        <a href="{{$cancel}}" class="btn btn-warning float-left">Cancel</a>
                        <button type="submit" class="btn btn-success float-right clickable">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
