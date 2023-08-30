<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $guarded = ['id'];

    // Scope
    public function scopeWhereHasBookings($query, $start, $end) {

        $query->where(function($q) use($start, $end) { // 解説 - 1

            $q->where('date_strat', '>=', $start)
                ->where('date_strat', '<', $end);

        })
        ->orWhere(function($q) use($start, $end) { // 解説 - 2

            $q->where('date_end', '>', $start)
                ->where('date_end', '<=', $end);

        })
        ->orWhere(function($q) use ($start, $end) { // 解説 - 3

            $q->where('date_strat', '<', $start)
                ->where('date_end', '>', $end);

        });

    }

    public function User() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function posts() {
        return $this->belongsTo('App\Posts', 'post_id', 'id');
    }
}
