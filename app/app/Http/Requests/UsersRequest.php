<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須入力です',
            'name.string' => '名前は文字のみでご入力下さい',
            'name.max:20' => '名前は20文字以内でご入力下さい',
            'email.required' => 'メールアドレスは必須入力です',
            'email.email' => 'メールアドレスは正しく入力して下さい',
        ];
    }
}
