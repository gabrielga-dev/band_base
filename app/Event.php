<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'date','time','Buy_url','local_name','street','complement','neighborhood','city','state', 'band_id'
    ];

    public function band()
    {
    	return belongsTo('App\Band');
    }
}
