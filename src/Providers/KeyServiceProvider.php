<?php

namespace Thihaeung\KeyLibrary\Providers;

use Illuminate\Support\ServiceProvider;

class KeyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../migrations/keys_table.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_keys.php'),
        ], 'key-migrations');
    }

    public function register()
    {

    }

}
