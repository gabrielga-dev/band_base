<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name', 'date_release', 'recording_company', 'genre', 'link_to_listen', 'description', 'user_id'
    ];
}
