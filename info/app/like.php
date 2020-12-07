<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id_like';

    public function Users()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function Post()
    {
        return $this->belongsTo('App\Post', 'id_post');
    }
    //
}
