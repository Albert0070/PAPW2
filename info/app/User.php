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

    public function userFollowing()
    {
        return $this->belongsToMany('App\follow', 'follows', 'id_user', 'id_follower');
    }

    public function userFollowers()
    {
        return $this->belongsToMany('App\follow', 'role_user', 'user_id', 'role_id');
    }
    protected $fillable = [
        'image','name', 'nick','address','phone','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
