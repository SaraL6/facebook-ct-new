<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    public function store(){
        $data= request()->validate([
            'friend_id' => ''
        ]);
      //  we're using findOrFail so that we throw an exception before we use the friends relationship in case the friend id is invalid/not found
      try{
        User::findOrFail($data['friend_id'])
        ->friends()->attach(auth()->user());
        //we find the new friend then we use the friends relationship to attach it to the authenticated user

      }catch(ModelNotFoundException $e){
                throw new UserNotFoundException();

      }

        return new FriendResource(
            Friend::where('user_id',auth()->user()->id)
            ->where('friend_id',$data['friend_id'])
            ->first()
        );



    }
}