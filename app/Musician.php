<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
    protected $fillable = [
    	'real_name', 'artistic_name', 'date_birth', 'age', 'function', 'is_active', 'user_id'
    ];
}
