<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = [
        'name', 'email', 'views', 'genre', 'active', 'new_page', 'history', 'owner_id', 'file_name'
    ];
    
    public function medias()
    {
    	return ('App\Media');
    }

    public function musicians()
    {
    	return belongsToMany('App\User');
    }

    public function albums()
    {
    	return hasMany('App\Album');
    }

    public function musics()
    {
    	return hasMany('App\Music');
    }
}
