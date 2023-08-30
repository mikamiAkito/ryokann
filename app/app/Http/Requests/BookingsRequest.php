<?php

namespace App\Http\Requests;

use App\Rules\BookingsRule;
use Illuminate\Foundation\Http\FormRequest;

class BookingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_strat' => [
                new BookingsRule(
                    $this->date_strat,
                    $this->date_end,
                )
            ]
        ];
    }

    public function all($keys = null)
    {
        $results = parent::all($keys);
        return $results;
    }
}
