<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band_User extends Model
{
	protected $table = 'band_user';
    protected $fillable = [
        'user_id', 'band_id', 'functions'
    ];
}
