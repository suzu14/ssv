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
        $input_user = Auth::id();
        $group->fill($input)->save();
        $group->users()->attach($input_user);
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
    
    public function search(Group $group, User $user)
    {
        //dd($group->all());
        return view('groups.search')->with(['groups' => $group->get(), 'users' => $user->get()]);
    }
    
    public function dosearch(Request $request)
    {
        $groups = Groups::query();
        $search = $request->input('search');
        
        $keyword = $request->input('keyword');
        if($search) {
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArraySearched as $value) {
                $query->where('name', 'like', '%'.$value.'%');
            }
            $users = $query;
        }
        
        return view('group.search')->with(['groups' => $groups, 'search' => $search,]);
    }
    
    public function register(Request $request, Group $group)
    {
        //dd($request['group']);
        $input_user = Auth::id();
        $group = Group::find($request['group']);
        $group->users()->attach($input_user);
        return redirect('/groups/' . $group->id);
    }
}
