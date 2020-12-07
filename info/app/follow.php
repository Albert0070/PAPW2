<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class follow extends Model
{
    protected $table = 'follows';
    protected $primaryKey = 'id_follow';

    public function userFollowers()
    {

    }
    public function userFollowing()
    {

    }
    //
}
