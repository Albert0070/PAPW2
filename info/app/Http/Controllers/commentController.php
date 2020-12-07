<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\comment;

class commentController extends Controller
{
    public function save(Request $request)
    {

        $validate = $this->validate($request, [
            'comment' => 'required|string|max:3000',
        ]);


        $text = $request->input('comment');

        //$post->tipoArchivo
        $comment = new comment();

        $comment->id_user = \Auth::user()->id;



        $comment->coment_user	 = $text;
        $comment->id_post = $request->input('id_post');

        // var_dump($comment);
        // die();
        $comment->save();
        return redirect()->back();
    }
    //
}
