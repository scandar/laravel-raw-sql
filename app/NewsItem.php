<?php

namespace App;

use App\DBModel;

class NewsItem extends DBModel
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'created_at',
        'view_count'
    ];

    function __construct()
    {
        $this->setTable('news_items');
    }
}
