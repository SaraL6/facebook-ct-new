<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Friend as FriendResource;

class Friend extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'data' =>[
                'type' => 'friend-request',
                'friend_request_id'=> $this->id,
                'attributes' =>[
                    //we add optional because the field is null at first , so diffForHumans only happens when the field is a value
                    'confirmed_at' =>optional($this->confirmed_at)->diffForHumans(),
                    'sender_name' =>  new FriendResource($this->sender_name),
                    'friend_id' => $this->friend_id,
                    'user_id' => $this->user_id,
                ]
                ],
                'links' =>[
                    'self' => url('/users/'.$this->friend_id),
                ]
                ];
    }
}
