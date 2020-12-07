<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    public function config()
    {
        return view('user.config');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $validate = $this->validate($request,[
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);
        $id = $user->id;
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $image = $request->file('image');



        if($image)
        {
            $image_path = time().$image->getClientOriginalName();
            Storage::disk('users')->put($image_path, File::get($image));
            $user->image = $image_path;
        }

        $user->name = $name;
        $user->address = $address;
        $user->phone = $phone;
        $user->update();

        return redirect()->route('config')
                        ->with(['message'=> 'usuario actualizado correctamente']);


    }

    //
}
