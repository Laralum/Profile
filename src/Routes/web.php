<?php

Route::group([
        'middleware' => ['web', 'laralum.base', 'auth'],
        'namespace'  => 'Laralum\Profile\Controllers',
        'as'         => 'laralum_public::',
    ], function () {
        Route::get('profile', 'ProfileController@publicProfile')->name('profile.index');
        Route::get('profile/edit', 'ProfileController@publicEditProfile')->name('profile.edit');
        Route::post('profile/edit', 'ProfileController@PublicUpdateProfile');
    });

Route::group([
        'middleware' => ['web', 'laralum.base', 'laralum.auth'],
        'prefix'     => config('laralum.settings.base_url'),
        'namespace'  => 'Laralum\Profile\Controllers',
        'as'         => 'laralum::',
    ], function () {
        Route::get('profile', 'ProfileController@profile')->name('profile.index');
        Route::get('profile/edit', 'ProfileController@editProfile')->name('profile.edit');
        Route::post('profile/edit', 'ProfileController@updateProfile');
    });
