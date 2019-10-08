<?php

namespace SQLiteForeignKeys;

use SQLiteForeignKeys\Blueprint;
use Illuminate\Database\SQLiteConnection as ParentSQLiteConnection;
use Illuminate\Database\Schema\SQLiteBuilder;

/**
 * Class SQLiteConnection
 *
 * @source  https://gist.github.com/m4grio/acff9ca3da62b6f4317f
 * @package App\Database
 */
class SQLiteConnection extends ParentSQLiteConnection
{
    /**
     * Get a schema builder instance for the connection.
     * Set {@see \SQLiteForeignKeys\Blueprint} for connection
     * Blueprint resolver
     *
     * @return \Illuminate\Database\Schema\SQLiteBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        $builder = new SQLiteBuilder($this);
        $builder->blueprintResolver(function ($table, $callback) {
            return new Blueprint($table, $callback);
        });

        return $builder;
    }
}
