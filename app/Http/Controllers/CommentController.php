<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Comment;
//use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Activity $activity, Comment $comment, User $user)
    {
        $input = $request['comment'];
        //dd($input);
        
        //ログイン中のuserのidを取得してstart_user_idに格納
        $comment->user_id = Auth::id();
        
        $comment->fill($input)->save();
        return redirect('activities/' . $activity->id);
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect('activities/' . $activity->id);
    }
}
