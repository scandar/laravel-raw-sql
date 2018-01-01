<?php

namespace App;

use App\AbstractDB;

class Image extends AbstractDB
{
    protected $fillable = ['path','item_id'];

    function __construct()
    {
        $this->setTable('images');
    }
}
