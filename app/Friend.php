<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $guarded= [];

    protected $dates= ['confirmed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //this is the id of the user that the authenticated user is supposed to be friends with
    public static function friendship($userId)
    {
        return (new static())
        ->where(function ($query) use ($userId) {
            return $query->where('user_id', auth()->user()->id)
                ->where('friend_id', $userId);
        })
        //inverse
        ->orWhere(function ($query) use ($userId) {
            return $query->where('friend_id', auth()->user()->id)
                ->where('user_id', $userId);
        })
        ->first();
    }
    //we grab all our friendships
    public static function friendships()
    {
        return (new static())
            ->whereNotNull('confirmed_at')
            ->where(function ($query) {
                return $query->where('user_id', auth()->user()->id)
                    ->orWhere('friend_id', auth()->user()->id);
            })
            ->get();
    }
    public static function friendRequests()
    {
        return (new static())
            ->whereNull('confirmed_at')
            ->where(function ($query) {
                return $query->where('user_id', auth()->user()->id)
                    ->orWhere('friend_id', auth()->user()->id);
            })
            ->get();
    }
}
