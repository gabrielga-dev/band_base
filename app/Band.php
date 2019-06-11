<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = [
        'name', 'email', 'views', 'genre', 'active', 'new_page', 'history', 'owner_id', 'file_name'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

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
    	return $this->belongsToMany('App\User')->withPivot('functions');
    }

    public function albums()
    {
    	return $this->hasMany('App\Album');
    }

    public function musics()
    {
        return $this->hasMany('App\Music');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
