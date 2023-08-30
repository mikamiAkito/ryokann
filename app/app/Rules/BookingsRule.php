<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BookingsRule implements Rule
{

    private  $_date_strat,
    $_date_end;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date_strat, $date_end)
    {
        $this->_date_strat = $start_at;
        $this->_date_end = $end_at;
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
        return \App\Bookings::whereHasBookings($this->_date_strat, $this->_date_end)
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
