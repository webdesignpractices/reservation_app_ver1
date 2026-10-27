<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NewMenuCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'newMenu' => ['required'],
            'newDuration' => ['required','integer','multiple_of'], //multiple_of 30の倍数でのルールが可能
            'newPrice' => ['required','integer'],
        ];
    }
    public function messages(){
        return [
            'newMenu.required' => '施術名は必須項目です',
            'newDuration.required' => '所要時間は必須項目です',
            'newPrice.required' => '料金は必須項目です',
            'newDuration.integer' => '所要時間は整数で入力してください',
            'newDuration.multiple_of' => '所要時間は30分単位で入力してください',
            'newPrice.integer' => '料金は整数で入力してください',
        ]
    }
}
