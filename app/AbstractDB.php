<?php

namespace App;

use DB;

abstract class AbstractDB
{
    protected $table_name;
    protected $fillable;
    private $_keys = [];
    private $_values = [];
    private $_marks = [];

    public function insert(array $arr)
    {

        // checking array keys are fillable
        // seperating keys from values
        $this->checkArray($arr);

        if (count($this->_keys)) {
            // creating query string
            $keys = implode($this->_keys, ', ');
            $marks = implode($this->_marks, ', ');
            $query = "INSERT INTO $this->table_name ($keys) VALUES ($marks)";

            // inserting into DB
            try {
                DB::select(DB::raw($query), $this->_values);
            } catch (Exception $e) {
                return false;
            }

            // return last id inserted using helper function
            // located in app/Support/Helpers.php
            return lastId();
        }
        return false;
    }

    public function update(array $data, $condition)
    {
        // checking array keys are fillable
        // seperating keys from values
        $this->checkArray($data);

        if (count($this->_keys)) {
            // creating query string
            $query = "UPDATE $this->table_name SET ";
            for ($i=0; $i < count($this->_keys); $i++) {
                $query .= $this->_keys[$i] ." = '". $this->_values[$i]."', ";
            }
            $query = rtrim($query,', ') . " WHERE ";

            foreach ($condition as $key => $value) {
                $query .= $key." = '".$value."', ";
            }
            $query = rtrim($query,', ');

            // inserting into DB
            try {
                DB::select(DB::raw($query), $this->_values);
            } catch (Exception $e) {
                return false;
            }

            // return last id inserted using helper function
            // located in app/Support/Helpers.php
            return true;
        }
        return false;
    }

    public function get($where = null)
    {

        // set array of conditions if it's an id
        if (is_numeric($where)) {
            $where = ['id' => $where];
        }

        // end if where isn't an array
        if (gettype($where) != "array" && $where != null) {
            return false;
        }

        // build query string
        if ($where != null) {
            $query = "SELECT * FROM $this->table_name ";
            if (count($where)) {
                $query .= "WHERE ";
                foreach ($where as $key => $value) {
                    $query .= $key." = :".$key.", ";
                }
                $query = rtrim($query,', ');
            }
        } else {
            $query = "SELECT * FROM $this->table_name";
            $where = [];
        }
        // fetch data
        try {
            $data = DB::select(DB::raw($query), $where);
        } catch (Exception $e) {
            return false;
        }
        // return fetched data
        return $data;
    }

    public function paginate(int $quantity, int $page = 0, $order = 'id')
    {
        // determine offset count
        $offset = $page * $quantity;
        $query = "SELECT * FROM $this->table_name ORDER BY $order LIMIT $quantity OFFSET $offset";

        // fetch data
        try {
            $data = DB::select(DB::raw($query));
        } catch (Exception $e) {
            return false;
        }
        return $data;
    }

    protected function setTable($name)
    {
        $this->table_name = $name;
    }

    protected function checkArray(array $arr)
    {
        $this->_keys   = [];
        $this->_values = [];
        $this->_marks  = [];

        foreach ($arr as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->_keys[] = $key;
                $this->_values[] = $value;
                $this->_marks[] = '?';
            }
        }
    }
}
