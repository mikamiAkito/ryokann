<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReservationRule implements Rule
{

    private  $_room_id,
    $_start_at,
    $_end_at;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($room_id, $start_at, $end_at)
    {
        $this->_room_id = $room_id;
        $this->_start_at = $start_at;
        $this->_end = $end_at;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return \App\Reservation::where('room_id', $this->_room_id)
        ->whereHasReservation($this->_start_at, $this->_end)
        ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '他の予約が入っています。';
    }
}
