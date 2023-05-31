<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function create()
    {
        return view('groups/create');
    }
    
    public function show(Group $group)
    {
        return view('groups.show')->with(['group' => $group]);
    }
    
    public function store(Request $request, Group $group)
    {
        $input = $request['group'];
        $group->fill($input)->save();
        return redirect('/groups/' . $group->id);
    }
}
