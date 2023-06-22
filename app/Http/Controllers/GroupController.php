<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('groups/create');
    }
    
    public function show(Group $group, User $user)
    {
        return view('groups.show')->with(['group' => $group, 'users' => $user->get()]);
    }
    
    public function store(Request $request, Group $group)
    {
        $input = $request['group'];
        $group->fill($input)->save();
        return redirect('/groups/' . $group->id);
    }
    
    public function edit(Group $group, User $user)
    {
        return view('groups.edit')->with(['group' => $group, 'users' => $user]);
    }
    
    public function update(Request $request, Group $group)
    {
        $input_group = $request['group'];
        //dd($input_group);
        $group->fill($input_group)->save();
    
        return redirect('/groups/' . $group->id);
    }
}
