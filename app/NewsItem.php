<?php

namespace App;

use App\DBModel;

class NewsItem extends DBModel
{
    // set columns names
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'created_at',
        'view_count'
    ];

    function __construct()
    {
        // set table name
        $this->setTable('news_items');
    }
}
