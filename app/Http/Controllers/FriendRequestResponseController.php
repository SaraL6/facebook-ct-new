<?php

namespace App\Http\Controllers;

use App\Exceptions\FriendRequestNotFoundException;
use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FriendRequestResponseController extends Controller
{
    public function store() {

        $data = request()->validate([
            'user_id' => 'required',
            'status' => 'required',
        ]);
        //we try to find the friend request that we're trying to update
        try{
         $friendRequest = Friend::where('user_id',$data['user_id'])
            ->where('friend_id',auth()->user()->id)
            ->firstOrFail();
        }catch (ModelNotFoundException $e) {
            throw new FriendRequestNotFoundException();

        }


        //we update and merge to the data that's above
        $friendRequest->update(array_merge($data,[
            'confirmed_at'=> now()
            
        ]));

        return new FriendResource($friendRequest);
    }

    public function destroy()
    {
            $data = request()->validate([
                'user_id'=>'required',
            ]);
            try {
                 Friend::where('user_id',$data['user_id'])
                    ->where('friend_id',auth()->user()->id)
                    ->firstOrFail()
                    ->delete();
             }catch (ModelNotFoundException $e) {

                throw new FriendRequestNotFoundException();

            }


        return response()->json([],204);
    }
}