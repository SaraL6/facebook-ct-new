<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use Illuminate\Http\Request;

class FriendRequestResponseController extends Controller
{
    public function store() {

        $data = request()->validate([
            'user_id' => '',
            'status' => '',
        ]);
        //we try to find the friend request that we're trying to update
        $friendRequest = Friend::where('user_id',$data['user_id'])
        ->where('friend_id',auth()->user()->id)
        ->firstOrFail();

        //we update and merge to the data that's above
        $friendRequest->update(array_merge($data,[
            'confirmed_at'=> now()
        ]));

        return new FriendResource($friendRequest);
    }
}