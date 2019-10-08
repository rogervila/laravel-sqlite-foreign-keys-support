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
        \Illuminate\Database\Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new \SQLiteForeignKeys\SQLiteConnection($connection, $database, $prefix, $config);
        });

        // Register the SQLite connection class as a singleton
        // because we only want to have one, and only one,
        // SQLite database connection at the same time.
        $this->app->singleton('db.connection.sqlite', function ($app, $parameters) {
            // First, we list the passes parameters into single
            // variables. I do this because it is far easier
            // to read than using it as eg $parameters[0].
            list($connection, $database, $prefix, $config) = $parameters;

            // Next we can initialize the connection.
            return new \SQLiteForeignKeys\SQLiteConnection($connection, $database, $prefix, $config);
        });
    }
}
