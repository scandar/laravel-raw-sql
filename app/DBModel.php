<?php

namespace App;

use DB;

class DBModel
{
    protected $table_name;
    protected $fillable;
    private $_query;
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
            $this->_query = "INSERT INTO $this->table_name ($keys) VALUES ($marks)";
            // inserting into DB
            $this->execute();
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
            $this->_query = "UPDATE $this->table_name SET ";
            for ($i=0; $i < count($this->_keys); $i++) {
                $this->_query .= $this->_keys[$i] ." = '". $this->_values[$i]."', ";
            }
            $this->_query = rtrim($this->_query,', ') . " WHERE ";

            foreach ($condition as $key => $value) {
                $this->_query .= $key." = '".$value."', ";
            }
            $this->_query = rtrim($this->_query,', ');
            // inserting into DB
            $this->execute();
            return true;
        }
        return false;
    }

    public function get($where = null)
    {
        // set array of conditions if it's an id
        $this->_values = $where;
        if (is_numeric($where)) {
            $this->_values = ['id' => $where];
        } elseif ($where == null) {
            $this->_values = [];
        }

        // end if where isn't valid
        if (gettype($where) != "array" && $where != null && !count($this->_values)) {
            return false;
        }

        // build query string
        if (count($this->_values)) {
            $this->_query = "SELECT * FROM $this->table_name ";
            $this->_query .= "WHERE ";
            foreach ($this->_values as $key => $value) {
                $this->_query .= $key." = :".$key.", ";
            }
            $this->_query = rtrim($this->_query,', ');
        } else {
            $this->_query = "SELECT * FROM $this->table_name ";
        }
        return $this;
    }

    public function delete(array $arr)
    {
        if (!count($arr)) {
            return false;
        }
        // building query
        $this->_query = "DELETE FROM $this->table_name WHERE ";

        foreach ($arr as $key => $value) {
            $this->_query .= "$key = :$key, ";
            $this->_values[$key] = $value;
        }
        $this->_query = rtrim($this->_query,', ');

        // deleting from db
        $this->execute();
        return true;
    }

    public function search($key,$val)
    {
        // set query string and return current context
        $this->_query = "SELECT * FROM $this->table_name WHERE $key LIKE '%$val%'";
        return $this;
    }

    public function paginate(int $quantity, int $page = 0, $order = 'id')
    {
        // limit fetched records and return current context
        $offset = $page * $quantity;
        $this->_query .= "ORDER BY $order LIMIT $quantity OFFSET $offset";
        return $this;
    }

    public function execute()
    {
        // run query string
        try {
            $data = DB::select(DB::raw($this->_query), $this->_values);
        } catch (Exception $e) {
            return false;
        }
        return $data;
    }

    public function searchDate($from,$to)
    {
        // set query string and values
        $this->_query = "SELECT * FROM $this->table_name WHERE created_at BETWEEN :frm AND :to ";
        $this->_values['frm'] = $from;
        $this->_values['to'] = $to;
        return $this;
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
