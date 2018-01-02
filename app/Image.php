<?php

namespace App;

use App\DBModel;

class Image extends DBModel
{
    protected $fillable = ['path','item_id'];

    function __construct()
    {
        $this->setTable('images');
    }
}
