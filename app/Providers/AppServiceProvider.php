<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // unguard all models
        \Eloquent::unguard();

        // set default password requirement to 10 characters to match ODK Central's default
        \Illuminate\Validation\Rules\Password::defaults(static function () {
            return Password::min(10);
        });

    }
}
