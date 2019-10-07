<?php

namespace SQLiteForeignKeys;

class Fixer
{
    public function fix()
    {
        \Illuminate\Database\Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new class ($connection, $database, $prefix, $config) extends \Illuminate\Database\SQLiteConnection
            {
                public function getSchemaBuilder()
                {
                    if ($this->schemaGrammar === null) {
                        $this->useDefaultSchemaGrammar();
                    }

                    return new class ($this) extends \Illuminate\Database\Schema\SQLiteBuilder
                    {
                        protected function createBlueprint($table, \Closure $callback = null)
                        {
                            return new class ($table, $callback) extends \Illuminate\Database\Schema\Blueprint
                            {
                                public function dropForeign($index)
                                {
                                    return new \Illuminate\Support\Fluent();
                                }
                            };
                        }
                    };
                }
            };
        });
    }
    }
}
