<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id_post';

    //
    //Muchos a Uno
    public function Users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','id_post', 'id_post');
    }

    public function likes()
    {
        return $this->hasMany('App\like', 'id_post','id_post');
    }
}
