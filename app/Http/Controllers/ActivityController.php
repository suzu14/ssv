<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function home(Activity $activity, Group $group, User $user)
    {
        $user = Auth::user();
        return view('home')->with(['activities' => $activity->getPaginateByLimit(), 'groups' => $group, 'user' => $user]);
    }
    
    public function show(Activity $activity, Comment $comment, Group $group, User $user)
    {
        $user = Auth::user();
        return view('activities/show')->with(['activity' => $activity, 'group' => $group, 'user' => $user]);
    }
    
    public function create(Group $group, User $user)
    {
        $user = Auth::user();
        return view('activities/create')->with(['groups' => $group->get(), 'users' => $user->get()]);
    }
    
    public function store(Request $request, Activity $activity)
    {
        //dd($request['activity']);
        $input_activity = $request['activity'];
        $input_user = $request['users_array'];
        
        //ログイン中のuserのidを取得してstart_user_idに格納
        $activity->start_user_id = Auth::id();
        
        foreach($input_user as $users_id) {
            //activitiesテーブルに保存
            $activity->fill($input_activity)->save();
            
            //attachメソッドでactivity_userテーブルにデータを保存
            $activity->users()->attach($users_id);
        }
        
        return redirect('/activities/' . $activity->id);
    }
    
    public function edit(Activity $activity, Group $group, User $user)
    {
        $user = Auth::user();
        return view('activities.edit')->with(['activity' => $activity, 'group' => $group, 'users' => $user]);
    }
    
    public function update(Request $request, Activity $activity)
    {
        $input_activity = $request['activity'];
        $activity->fill($input_activity)->save();
    
        return redirect('/activities/' . $activity->id);
    }
    
    public function delete(Activity $activity)
    {
        $activity->delete();
        return redirect('/');
    }
}
