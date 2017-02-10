@extends('laralum::layouts.public')
@section('title', 'Account settings')
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
                        <div class="row">
                            <div class="col-6">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="save_photo" id="save_photo" class="custom-control-input" @if($user->hasAvatar()) checked @endif>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Save photo</span>
                                    </label>
                            </div>
                            <div class="col-6">
                                <label class="custom-file">
                                    <input type="file" id="file" name="photo" value="{{old('photo')}}" class="custom-file-input">
                                    <span class="custom-file-control"></span>
                                </label>
                            </div>
                        </div>
                        <br>
                        @foreach ($fields as $field => $type)
                            <div class="form-group">
                                <label for="{{ $field }}">{{ str_replace('_', ' ', ucfirst($field)) }}</label>
                                <input type="{{ $type }}" name="{{ $field }}" value="@if($type != 'password'){{ old($field, isset($user->$field) ? $user->$field : '' ) }}@endif" class="form-control" id="{{ $field }}">
                            </div>
                        @endforeach
                        <a href="#" class="btn btn-warning float-left">Cancel</a>
                        <button type="submit" class="btn btn-success float-right clickable">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
