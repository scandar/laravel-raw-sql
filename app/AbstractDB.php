<?php

namespace App;

use DB;

abstract class AbstractDB
{
    protected $table_name;
    protected $fillable;

    public function insert(array $arr)
    {
        $keys = [];
        $values = [];

        // checking array keys are fillable
        // seperating keys from values
        foreach ($arr as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $keys[] = $key;
                $values[] = $value;
                $marks[] = '?';
            }
        }

        if (count($keys)) {
            // creating query string
            $keys = implode($keys, ', ');
            $marks = implode($marks, ', ');
            $query = "INSERT INTO $this->table_name ($keys) VALUES ($marks)";

            // inserting into DB
            try {
                DB::select(DB::raw($query), $values);
            } catch (Exception $e) {
                return false;
            }

            // return last id inserted using helper function
            // located in app/Support/Helpers.php
            return lastId();
        }

    }

    protected function setTable($name)
    {
        $this->table_name = $name;
    }
}
