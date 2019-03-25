<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    protected $fillable = [
        'place_of_origin', 'date_criation', 'content', 'user_id'
    ];
}
