<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social_Media extends Model
{
	protected $table = 'social_media';
    protected $fillable = [
        'url', 'name', 'band_id'
    ];
    private static $conhecidas = ['Bandcamp', 'Facebook', 'Instagram', 'Spotfy', 'Twitter', 'Youtube'];


    public function band()
    {
    	return belongsTo('App\Band');
    }

    public static function is_conhecida($name)
    {
    	$boo = false;
    	foreach (Social_Media::$conhecidas as $con) {
    		if($name == $con){
    			$boo = true;
    		}
    	}
    	return $boo;
    }
}
