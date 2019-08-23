<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blog_posts";
    protected $fillable =[
        'id', 'title', 'author', 'content'
    ];
}
