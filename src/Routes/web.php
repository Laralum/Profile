<?php

Route::group([
        'middleware' => ['web', 'laralum.base', 'laralum.auth'],
        'prefix' => config('laralum.settings.base_url'),
        'namespace' => 'Laralum\Profile\Controllers',
        'as' => 'laralum::'
    ], function () {
        // First the suplementor, then the resource
        // https://laravel.com/docs/5.4/controllers#resource-controllers

        Route::get('profile', 'ProfileController@publicProfile')->name('public.profile');
        Route::get('profile/edit', 'ProfileController@publicEditProfile')->name('public.profile.edit');
        Route::post('profile/edit', 'ProfileController@PublicUpdateProfile');
});

Route::group([
        'middleware' => ['web', 'laralum.base'],
        'namespace' => 'Laralum\Profile\Controllers',
        'as' => 'laralum_public::'
    ], function () {
        // First the suplementor, then the resource
        // https://laravel.com/docs/5.4/controllers#resource-controllers

        Route::get('profile', 'ProfileController@profile')->name('profile');
        Route::get('profile/edit', 'ProfileController@editProfile')->name('profile.edit');
        Route::post('profile/edit', 'ProfileController@updateProfile');
});
