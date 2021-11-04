<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\ValidationErrorException;
use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use App\Http\Resources\FriendCollection;
use App\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserFriendRequestController extends Controller
{
    public function index()
    {
        $friendRequests=Friend::friendRequests();
        if ($friendRequests->isEmpty()) {
            //in which case we return the auth user's posts
            return 'No Friend Requests';
        }
        return new FriendCollection(
            Friend::whereIn('user_id', [$friendRequests->pluck('user_id'),$friendRequests->pluck('friend_id')])
            ->get()
        );
    }

    public function store()
    {
        $data= request()->validate([
                'friend_id' => 'required',

            ]);
        //         return response()->json([
        //             'errors' => [
        //                 'code'=>422,
        //                 'title'=>'Validation Error',
        //                 'detail' => 'Your request is malformed or missing fields',
        //                 'meta'=> $e->errors()
        //             ]
        //             ],422);
        //     }

        //   //  we're using findOrFail so that we throw an exception before we use the friends relationship in case the friend id is invalid/not found
        try {
            User::findOrFail($data['friend_id'])
         ->friends()->syncWithoutDetaching(auth()->user());
            //     //we find the new friend then we use the friends relationship to attach it to the authenticated user
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }

        return new FriendResource(
            Friend::where('user_id', auth()->user()->id)
            ->where('friend_id', $data['friend_id'])

            ->first()
        );
    }


}