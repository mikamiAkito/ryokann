<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = ['id'];

    // Scope
    public function scopeWhereHasReservation($query, $start, $end) {

        $query->where(function($q) use($start, $end) { // 解説 - 1

            $q->where('start_at', '>=', $start)
                ->where('start_at', '<', $end);

        })
        ->orWhere(function($q) use($start, $end) { // 解説 - 2

            $q->where('end_at', '>', $start)
                ->where('end_at', '<=', $end);

        })
        ->orWhere(function($q) use ($start, $end) { // 解説 - 3

            $q->where('start_at', '<', $start)
                ->where('end_at', '>', $end);

        });

    }
}
