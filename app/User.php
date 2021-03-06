<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $with= ['profileImage'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  

    public function images()
    {
        return $this->hasMany(UserImage::class);
    }

    public function coverImage()
    {
        return $this->hasOne(UserImage::class)
        //we're returning the latest image added
        ->orderByDesc('id')
        ->where('location', 'cover')
        ->withDefault(function ($userImage) {
            $userImage->path = 'user-images/cover-default-image.png';
        });
    }

    public function profileImage()
    {
        return $this->hasOne(UserImage::class)
        //we're returning the latest image added
        ->orderByDesc('id')
        ->where('location', 'profile')

        ->withDefault(function ($userImage) {
            $userImage->path = 'user-images/profile-default-image.jpeg';
        });
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    //we create a pivot table called friends that belongs to friend_id and  is related to user_id
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }
    public function friendRequests()
    {
        return $this->hasMany(Friend::class, 'friend_id')
        ->whereNull('confirmed_at')
        ->where(function ($query) {
            return $query->where('user_id', auth()->user()->id)
                ->orWhere('friend_id', auth()->user()->id);
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}