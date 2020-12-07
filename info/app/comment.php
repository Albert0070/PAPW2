<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    protected $table = 'comments';

    public function Users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    public function Post()
    {
        return $this->belongsTo('App\Post', 'id_post');
    }
}
