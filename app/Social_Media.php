<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social_Media extends Model
{
    protected $fillable = [
        'url', 'name', 'band_id'
    ];


    public function band()
    {
    	return belongsTo('App\Band');
    }
}
