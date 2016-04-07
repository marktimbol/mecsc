<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mecsc\ViewComposers\CurrentUserProfile;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            '*', CurrentUserProfile::class
        );
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
