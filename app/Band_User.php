<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band_User extends Model
{
    protected $fillable = [
        'user_id', 'band_id', 'functions'
    ];
}
