<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\like;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $archives = Post::orderBy('id_post', 'desc')->get();
        $follows = null;
        if(\Auth::user())
        {
            $follows = DB::select('select * from follows where id_follower = ?', [\Auth::user()->id]);

        }

        // var_dump($follows);
        // die();
        // foreach($archives as $archive)
        // {
        //     var_dump($archive->Users->nick);
        // }
        // die();
            // if(\Auth::user())
            // {
            //     $follows = DB::table('follows')->where('id_follower','=',\Auth::user()->id)->get();
            //     var_dump($follows);
            //     die();
            // }


        return view('landing',[
            'landingPosts' => $archives,
            'myFollows' => $follows
        ]);
    }
    public function search(Request $request)
    {

        $game = $request->input('search');

        $archives = Post::where('game','LIKE','%'.$game.'%')->orderBy('id_post', 'desc')->get();
        $follows = null;
        if(\Auth::user())
        {
            $follows = DB::select('select * from follows where id_follower = ?', [\Auth::user()->id]);

        }

        //var_dump($archives);
        // die();
        // foreach($archives as $archive)
        // {
        //     var_dump($archive->Users->nick);
        // }
        // die();
            // if(\Auth::user())
            // {
            //     $follows = DB::table('follows')->where('id_follower','=',\Auth::user()->id)->get();
            //     var_dump($follows);
            //     die();
            // }


        return view('landing',[
            'landingPosts' => $archives,
            'myFollows' => $follows
        ]);
    }
    public function mostComment()
    {
        $archives = Post::withCount('comments')->orderBy('comments_count', 'desc')->get();
        //$archives = Post::all();

        $follows = null;
        if(\Auth::user())
        {
            $follows = DB::select('select * from follows where id_follower = ?', [\Auth::user()->id]);

        }

        // var_dump($archives);
        // die();
        // foreach($archives as $archive)
        // {
        //     var_dump($archive->game);
        //     var_dump($archive->publicationText);
        // }
        //die();
            // if(\Auth::user())
            // {
            //     $follows = DB::table('follows')->where('id_follower','=',\Auth::user()->id)->get();
            //     var_dump($follows);
            //     die();
            // }


        return view('landing',[
            'landingPosts' => $archives,
            'myFollows' => $follows
        ]);
    }

    public function mostLike()
    {
        $archives = Post::withCount('likes')->orderBy('likes_count', 'desc')->get();
        //$archives = Post::all();

        $follows = null;
        if(\Auth::user())
        {
            $follows = DB::select('select * from follows where id_follower = ?', [\Auth::user()->id]);

        }

        // var_dump($archives);
        // die();
        // foreach($archives as $archive)
        // {
        //     var_dump($archive->game);
        //     var_dump($archive->publicationText);

        // }
        // die();
            // if(\Auth::user())
            // {
            //     $follows = DB::table('follows')->where('id_follower','=',\Auth::user()->id)->get();
            //     var_dump($follows);
            //     die();
            // }


        return view('landing',[
            'landingPosts' => $archives,
            'myFollows' => $follows
        ]);
    }


    public function getVideo($name)
    {
        $fileContents = Storage::disk('posts')->get($name);
        $response = FacadeResponse::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");
        return $response;
    }

    public function create()
    {

    }

    public function getImage($filename)
    {
        $file = Storage::disk('posts')->get($filename);
        return new Response($file, 250);
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'image' => 'nullable',
            'game' => 'required|string|max:255',
            'publicationText' => 'required|string|max:3000',
        ]);

        $archivo = $request->file('image');

        $game = $request->input('game');
        $text = $request->input('publicationText');



        //$post->tipoArchivo
        $post = new Post();

        $post->id_user = \Auth::user()->id;

        if($archivo)
        {
            $archive_path = time().$request->file('image')->getClientOriginalName();
            $hey = File::get($request->file('image'));
            Storage::disk('posts')->put($archive_path, File::get($request->file('image')));
            $post->archivo = $archive_path;
            $post->tipoArchivo = $request->file('image')->getMimeType();

        }



        $post->game = $game;
        $post->publicationText = $text;

        $post->save();
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validate = $this->validate($request, [
            'game' => 'required|string|max:255',
            'publicationText' => 'required|string|max:3000',
        ]);



        $id_post = (int)$request->input('id');
        $game = $request->input('game');
        $text = $request->input('publicationText');



        //$post->tipoArchivo
        $post = Post::find($id_post);

        //var_dump($post);
        $archivo = $request->file('image');

        if($archivo)
        {
            $archive_path = time().$request->file('image')->getClientOriginalName();
            $hey = File::get($request->file('image'));
            Storage::disk('posts')->put($archive_path, File::get($request->file('image')));
            $post->archivo = $archive_path;
            $post->tipoArchivo = $request->file('image')->getMimeType();

        }

        $post->game = $game;
        $post->publicationText = $text;
        $post->save();
        return redirect()->back();
    }
    public function postPage($id)
    {
        $archive = Post::find($id);
        //echo $archive;
        //var_dump($archive);

        //secho $id;
        // var_dump($archive->publicationText);
        // die();

        return view('updatePost',[
            'publication' => $archive,
        ]);
    }

}
