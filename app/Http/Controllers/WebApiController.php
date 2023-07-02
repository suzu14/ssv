<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class WebApiController extends Controller
{
    public function getMemberList(Request $request) {
        $userVal = $request['user_val'];
        $user = User::where('group_id', $userVal)->get();
        $result = [];
        foreach ($group as $item) {
            $result[$item->id] = $item->user;
        }
        return response()->json($result);
    }
}
