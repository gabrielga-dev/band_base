<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name', 'launch_date', 'recorder', 'buy_url', 'genre', 'band_id'
    ];

    public function band()
    {
    	return belongsTo('App\Band');
    }
    
    public function musics()
    {
    	return hasMany('App\Music');
    }
}
