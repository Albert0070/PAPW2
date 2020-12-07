<?php

namespace App\Http\Controllers;
use App\like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function likes($id_post)
    {
        $id_user = \Auth::user()->id;

        $isset_like = like::where('id_user', $id_user)
                                ->where('id_post',$id_post)
                                ->count();

        if($isset_like == 0)
        {
            $Like = new like();

            $Like->id_user = $id_user;
            $Like->id_post = (int)$id_post;

            $Like->save();

        }
        return redirect()->back();


    }
    public function dislikes($id_post)
    {
        $id_user = \Auth::user()->id;

        $like = like::where('id_user', $id_user)
                                ->where('id_post',$id_post)
                                ->first();

        if($like)
        {

            $like->delete();



        }

        return redirect()->back();

    }
}
