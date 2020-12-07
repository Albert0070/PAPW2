<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\follow;

class FollowController extends Controller
{
    public function publicacionFollow()
    {
        if(isset(\Auth::user()->id))
        {
            $datos =  $follows = DB::select('
            SELECT p.id_post ,u.id, u.nick, p.game, p.archivo, p.tipoArchivo,p.publicationText, uc.nick as nickComment,c.coment_user
            FROM follows f
            JOIN users u
            ON f.id_user = u.id
            JOIN post p
            ON p.id_user = u.id
            LEFT JOIN comments c
            ON p.id_post = c.id_post
            LEFT JOIN users uc
            ON uc.id = c.id_user

            where id_follower = ?
            ORDER BY p.id_post DESC, c.id_comment ASC', [\Auth::user()->id]);
            // foreach($datos as $dato)
            // {
            //     var_dump($dato);

            // }
            return view('people',[
                'landingPosts' => $datos,
            ]);
        }else
        {
            return view('logout');
        }
    }



    public function peopleWhoFollow()
    {
        if(isset(\Auth::user()->id))
        {
            $datos =  $follows = DB::select("
            SELECT f.id_follow ,nick, DATE_FORMAT(f.created_at, '%e %b %Y') AS startFollow
            FROM follows f
            JOIN users u
            ON f.id_follower = u.id

            WHERE f.id_user = ?
            ORDER BY f.id_follow DESC", [\Auth::user()->id]);

            //var_dump($datos);
            // foreach($datos as $dato)
            // {
            //     var_dump($dato);

            // }
            return view('followU',[
                'landingPosts' => $datos,
            ]);
        }else
        {
            return view('logout');
        }
    }

    public function beFollower($id_user)
    {
        $entro = 'entro';

        $id_u = \Auth::user()->id;

        $followCheck = follow::where('id_user', $id_user)
        ->where('id_follower', $id_u)
                                ->first();
        // $followCheck = follow::where('id_user', $id_u)
        // ->where('id_follower', $id_user)
        //                         ->first();
        if($followCheck)
        {
            echo 'ya lo sigues men';
            die();
        }
        else{
                    $follow = new follow();
        $follow->id_user = $id_user;
        $follow->id_follower = $id_u;
        var_dump($followCheck);
        $follow->save();

        }

        return redirect()->back();
    }
    public function dontBeFollower($id_user)
    {
        $id = \Auth::user()->id;

        $like = follow::where('id_user', $id_user)
                                ->where('id_follower',$id)
                                ->first();
        $yaLike = 'ya likeado';
        // var_dump($like);
        // die();
        if($like)
        {

            $like->delete();



        }

        return redirect()->back();
    }
}
