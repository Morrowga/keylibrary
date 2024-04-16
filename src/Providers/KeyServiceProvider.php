<?php

namespace Thihaeung\KeyLibrary\Providers;

use Illuminate\Support\ServiceProvider;

class KeyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $timestamp = now()->format('Y_m_d_His');
        $microseconds = now()->format('u');

        $this->publishes([
            __DIR__.'/../migrations/keys_table.php' => database_path('migrations/' . $timestamp . $microseconds  . '_create_keys.php'),
        ], 'key-migrations');
    }

    public function register()
    {
    }
}
