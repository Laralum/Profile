<?php

namespace Laralum\Profile;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/Translations', 'laralum_profile');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        $this->publishes([
            __DIR__.'/Views/public' => resource_path('views/vendor/laralum/profile'),
        ], 'laralum_profile');

        $this->loadViewsFrom(__DIR__.'/Views', 'laralum_profile');
        //$this->loadViewsFrom(resource_path('views/vendor/Laralum/Profile'), 'laralum_profile_public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
