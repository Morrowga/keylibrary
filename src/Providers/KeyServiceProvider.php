<?php

namespace Thihaeung\KeyLibrary\Providers;

use Illuminate\Support\ServiceProvider;

class KeyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $timestamp = now()->format('Y_m_d_His_u');

        $this->publishes([
            __DIR__.'/../migrations/keys_table.php' => database_path('migrations/' . $timestamp . '_create_keys.php'),
        ], 'key-migrations');
    }

    public function register()
    {
    }
}
