<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
            'title' => 'required',
            'date_strat' => 'required',
            'date_end' => 'required',
            'amount' => 'required|integer',
            'explanation' => 'required',
            'image' => 'required',
            'image2' => 'required',
            'image3' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは入力必須です',
            'date_strat.required' => '予約開始日は入力必須です',
            'date_end.required' => '予約終了日は入力必須です',
            'amount.required' => '金額は入力必須です',
            'amount.integer' => '金額は数字のみでご入力下さい',
            'explanation.required' => '内容は入力必須です',
            'image.required' => '画像は必須入力です',
            'image2.required' => '画像は必須入力です',
            'image3.required' => '画像は必須入力です',
        ];
    }
}
