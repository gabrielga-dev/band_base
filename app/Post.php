<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'brief','content', 'band_id'
    ];


    public function band()
    {
    	return belongsTo('App\Band');
    }
}
