<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    public function User() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function posts() {
        return $this->belongsTo('App\Posts', 'post_id', 'id');
    }
}
