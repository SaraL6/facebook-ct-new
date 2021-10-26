<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use App\Post;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        //we grab all our friends, that may be empty
        $friends = Friend::friendships();
        if($friends->isEmpty())
        {
            //in which case we return the auth user's posts
            return new PostCollection(request()->user()->posts);
        }
        return new PostCollection(
           // if we have friends we grab every post where the owner of the post = to all the user ids from my friends or all the friend ids from my friends
            Post::whereIn('user_id',[$friends->pluck('user_id'),$friends->pluck('friend_id')])
            ->get()
        );
    }

    public function store()
    {
        $data = request()->validate([
            'body' => '',
            'image' => '',
            'width' => '',
            'height' => '',
        ]);

        //if the post includes an image
        if (isset($data['image'])) {
            $image = $data['image']->store('post-images', 'public');

            Image::make($data['image'])
                ->fit($data['width'], $data['height'])
                ->save(storage_path('app/public/post-images/'.$data['image']->hashName()));
        }

        $post = request()->user()->posts()->create([
            'body' => $data['body'],
            'image' => $image ?? null,
        ]);
        return new PostResource($post);


    }
}