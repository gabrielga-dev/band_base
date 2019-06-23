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
    	return $this->belongsTo('App\Band');
    }

    public function pegaData()
    {
    	$meses = ['Janeiro','Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    	$mes = date('m',strtotime($this->date));
    	return $meses[$mes-1];
    }
}
