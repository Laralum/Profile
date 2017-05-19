<?php

Route::group([
        'middleware' => ['web', 'laralum.base', 'auth'],
        'namespace'  => 'Laralum\Profile\Controllers',
        'as'         => 'laralum_public::profile.',
    ], function () {
        Route::get('profile', 'ProfileController@publicProfile')->name('index');
        Route::get('profile/edit', 'ProfileController@publicEditProfile')->name('edit');
        Route::post('profile/edit', 'ProfileController@PublicUpdateProfile')->name('update');
    });

Route::group([
        'middleware' => ['web', 'laralum.base', 'laralum.auth'],
        'prefix'     => config('laralum.settings.base_url'),
        'namespace'  => 'Laralum\Profile\Controllers',
        'as'         => 'laralum::profile.',
    ], function () {
        Route::get('profile', 'ProfileController@profile')->name('index');
        Route::get('profile/edit', 'ProfileController@editProfile')->name('edit');
        Route::post('profile/edit', 'ProfileController@updateProfile')->name('update');
    });
