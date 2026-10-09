<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model

{
    use \App\Traits\LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image',
        'is_published',
    ];
}

