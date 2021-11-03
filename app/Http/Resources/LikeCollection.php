<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LikeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'=>$this->collection,
            'like_count' => $this->count(),
            //does this collection contain in the id column , the authenticated user's id?, so checking if the authenticated user had liked the post
            'user_likes_post' => $this->collection->contains('id', auth()->user()->id),
            'links'=> [
                'self' =>url('/posts'),
            ]
            ];
    }
}
