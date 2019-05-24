<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'type', 'url','file_name','description', 'band_id'
    ];

    public function band()
    {
    	return belongsTo('App\Band');
    }
}
