<?php

namespace App;

use App\AbstractDB;

class NewsItem extends AbstractDB
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
