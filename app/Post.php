<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['reference', 'title', 'content', 'urlid', 'date'];
    //
}
