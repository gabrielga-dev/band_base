<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = [
        'name', 'email', 'views', 'genre', 'active', 'new_page', 'history', 'owner_id', 'file_name'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function social_medias()
    {
        return $this->hasMany('App\Social_Media');
    }
    
    public function medias()
    {
    	return $this->hasMany('App\Media');
    }

    public function musicians()
    {
    	return $this->belongsToMany('App\User');
    }

    public function albums()
    {
    	return $this->hasMany('App\Album');
    }

    public function musics()
    {
    	return $this->hasMany('App\Music');
    }
}
