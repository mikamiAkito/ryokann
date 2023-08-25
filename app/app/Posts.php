<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    protected $fillable = ['title', 'user_id', 'date', 'created_at', 'updated_at', 'image', 'image2', 'image3', 'amount', 'explanation'];

    public function User() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
