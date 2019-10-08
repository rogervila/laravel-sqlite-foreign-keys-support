<?php

namespace SQLiteForeignKeys;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Fluent;

/**
 * @source https://github.com/laravel/framework/issues/17548
 */
class SQLiteForeignKeysServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        \DB::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new \SQLiteForeignKeys\SQLiteConnection($connection, $database, $prefix, $config);
        });
    }
}
