<?php

namespace Thihaeung\KeyLibrary\Providers;

use Illuminate\Support\ServiceProvider;

class KeyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations'),
        ], 'key-migrations');
    }

    public function register()
    {

    }
}
