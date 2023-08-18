<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usert_tokens extends Model
{
    public function User() {
        return $this->hasOne('App\User', 'user_id', 'id');
    }
}
