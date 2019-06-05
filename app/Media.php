<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'type', 'url', 'file_name', 'title', 'description', 'band_id'
    ];

    public function band()
    {
    	return $this->belongsTo('App\Band');
    }
}
