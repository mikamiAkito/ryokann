<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Likes;

class Posts extends Model
{

    protected $fillable = ['title', 'user_id', 'date', 'created_at', 'updated_at', 'image', 'image2', 'image3', 'amount', 'explanation'];

    public function User() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\Likes');
    }

    public function isLikedBy($user): bool {
        return Likes::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
}
