<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = [
        'name', 'genre', 'number', 'link_to_listen', 'user_id'
    ];
}
