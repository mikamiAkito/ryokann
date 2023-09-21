<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User; 

class UniqueName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // データベース内で同じ名前を持つユーザーが存在するかどうかを確認
        return User::where('name', $value)->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'この名前はすでに使用されています。別の名前を選択してください。';
    }
}
