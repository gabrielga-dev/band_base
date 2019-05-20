<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = [
        'name', 'genre','number','album_id', 'band_id'
    ];


    public function album()
    {
    	return belongsTo('App\Album');
    }

    public function band()
    {
    	return belongsTo('App\Band');
    }
}
