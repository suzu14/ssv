<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class UserController extends Controller
{
    public function show(User $user, Group $group)
    {
        return view('users.show')->with(['user' => $user, 'group' => $group]);
    }
    
    public function upload(Request $request, User $user)
    {
        $input = $request["user"];
        
        if($request->file('profile_image') != NULL){
            //cloudinaryへ画像を送信し、画像のURLを$user->image_pathに代入している
            $user->image_path = Cloudinary::upload($request->file('profile_image')->getRealPath())->getSecurePath();
        }
        
        $user->save();
        //dd($document);
        
        return redirect('/users/' . $user->id);
    }
}
