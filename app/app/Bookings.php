<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{

    protected $dates = ['date_end', 'date_strat',];

    protected $guarded = ['id'];

    // Scope
    public function scopeWhereHasBookings($start, $end) {

        
        $bookin = $this->where(function($q) use($start, $end) {

            $q->where('date_strat', '>=', $start)
                ->where('date_strat', '<', $end);

        })
        ->orWhere(function($q) use($start, $end) {

            $q->where('date_end', '>', $start)
                ->where('date_end', '<=', $end);

        })
        ->orWhere(function($q) use ($start, $end) {

            $q->where('date_strat', '<', $start)
                ->where('date_end', '>', $end);

        })->doesntExist();

        return $bookin;
    }

    public function User() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function posts() {
        return $this->belongsTo('App\Posts', 'post_id', 'id');
    }
}
