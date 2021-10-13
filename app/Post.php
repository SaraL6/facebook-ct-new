<?php

namespace App;

use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
       parent::boot();

       static::addGlobalScope(new ReverseScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        //we create a pivot table called likes that belongs to post_id and  is related to user_id
        return $this->belongsToMany(User::class, 'likes', 'post_id','user_id');
    }
}