<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'is_profile', 'title', 'subtitle', 'file_name', 'user_id'
    ];
}
