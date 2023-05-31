<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function home(Activity $activity, Group $group)
    {
        return view('home')->with(['activities' => $activity->getPaginateByLimit(), 'groups' => $group->get()]);
    }
    
    public function show(Activity $activity, Group $group, User $user)
    {
        return view('activities/show')->with(['activity' => $activity, 'group' => $group, 'user' => $user]);
        //dd($activity);
    }
    
    public function create(Group $group, User $user)
    {
        return view('activities/create')->with(['groups' => $group->get(), 'users' => $user->get()]);
    }
    
    public function store(Request $request, Activity $activity)
    {
        //dd($request['activity']);
        $input_activity = $request['activity'];
        $input_user = $request['participants'];
        
        //ログイン中のuserのidを取得してstart_user_idに格納
        $activity->start_user_id = Auth::id();
        
        //activitiesテーブルに保存
        $activity->fill($input_activity)->save();
        
        //attachメソッドでactivity_userテーブルにデータを保存
        $activity->users()->attach($input_user);
        
        return redirect('/activities/' . $activity->id);
    }
    
    public function edit(Activity $activity, Group $group, User $user)
    {
        return view('activities.edit')->with(['activity' => $activity, 'group' => $group, 'users' => $user]);
    }
    
    public function update(Request $request, Activity $activity)
    {
        $input_activity = $request['activity'];
        //dd($input_activity);
        $activity->fill($input_activity)->save();
    
        return redirect('/activities/' . $activity->id);
    }
    
    public function delete(Activity $activity)
    {
        $activity->delete();
        return redirect('/');
    }
}
