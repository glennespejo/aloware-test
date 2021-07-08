<?php

namespace App\Helpers;

use DB;

class Helpers
{
    /**
     * Dump all the dump queries executed
     */
    public static function dumpQueries()
    {
        // cannot dump queries in production environment
        if(app()->environment() !== 'production') {
            DB::listen(function($queryObject) {
                dump([
                    'query' => $queryObject->sql,
                    'bindings' => $queryObject->bindings,
                    'time' => "{$queryObject->time}ms"
                ]);
            });
        }
    }

    /**
     * Dump the peak memory for a request
     */
    public static function dumpPeakMemory()
    {
        $peakMemory = round(memory_get_peak_usage() / 1024 / 1024);
        dump("Peak memory: {$peakMemory}MB");
    }

    /**
     * Check if a value is a valid int
     *
     * @param $value
     *
     * @return boolean
     */
    public static function isInt($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    /**
     * Check if an array is associative
     *
     * @param array $arr
     *
     * @return bool
     */
    public static function isAssoc(array $arr)
    {
        if ([] === $arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
