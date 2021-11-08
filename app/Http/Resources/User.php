<?php
//this resource returns all the necessary data to display a profile properly

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Friend as FriendResource;

use App\Http\Resources\UserImage as UserImageResource;
use App\Friend;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);
        $friendRequests=$this->friendrequests;
        foreach ($friendRequests as $friendRequest) {
            //  dd($friendRequest->getAttributes()['created_at']);
          //  dd(strtotime($friendRequest->getAttributes()['created_at']));
        };
        return [
            
            'data' => [
                'type' => 'users',
                'user_id' => $this->id,
                'attributes' => [
                    'name' => $this->name,
                    'friendship' => new FriendResource(Friend::friendship($this->id)),
                    //'friend_requests' => $friendRequests,
                    'friend_requests' =>  new FriendCollection($this->friendrequests),
                    //Friend::friendship($this->id) is the id of the user's profile we're trying to get
                    'cover_image' => new UserImageResource($this->coverImage),
                    'profile_image' => new UserImageResource($this->profileImage),

                ]
            ],
            'links' => [
                'self' => url('/users/'.$this->id),
            ]
        ];
    }
}