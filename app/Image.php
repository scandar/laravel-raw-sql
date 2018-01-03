<?php

namespace App;

use App\DBModel;

class Image extends DBModel
{
    // set columns names
    protected $fillable = ['path','item_id'];

    function __construct()
    {
        //set table name
        $this->setTable('images');
    }
}
