<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tag', 'birth_date', 'age', 'artistic_name', 'file_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function bandsOwn()
    {
        return $this->hasMany('App\Band', 'owner_id');
    }
    public function bandsOf()
    {
        return $this->belongsToMany('App\Band')->withPivot('functions');
    }
}
