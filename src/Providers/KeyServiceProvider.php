<?php

namespace Thihaeung\KeyLibrary\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Thihaeung\KeyLibrary\Commands\DeleteKeyCollectionCommand;

class KeyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $existingMigrations = File::glob(database_path('migrations/*_create_keys.php'));

        if (empty($existingMigrations)) {
            $timestamp = now()->format('Y_m_d_His');
            $microseconds = now()->format('u');

            $this->publishes([
                __DIR__.'/../migrations/keys_table.php' => database_path('migrations/' . $timestamp . $microseconds  . '_create_keys.php'),
            ], 'key-migrations');

        }
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DeleteKeyCollectionCommand::class,
            ]);
        }

    }
}
