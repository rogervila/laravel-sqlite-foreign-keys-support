<?php

namespace SQLiteForeignKeys;

class Blueprint extends \Illuminate\Database\Schema\Blueprint
{
    /**
     * Indicate that the given foreign key should be dropped.
     *
     * @param  string|array  $index
     * @return \Illuminate\Support\Fluent
     */
    public function dropForeign($index)
    {
        if (\DB::getDriverName() === 'sqlite') {
            return new \Illuminate\Support\Fluent();
        }

        return parent::dropForeign($index);
    }
}
