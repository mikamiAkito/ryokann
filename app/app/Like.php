<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }

    public function like_exist($user_id, $posts_id)
    {
        return Like::where('user_id', $user_id)->where('posts_id', $posts_id)->exists();
    }
}
