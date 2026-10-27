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
            'name' => ['required'],
            'duration_minutes' => ['required','integer','multiple_of:30'], //multiple_of 30の倍数でのルールが可能
            'price' => ['required','integer'],
        ];
    }
    public function messages(){
        return [
            'name.required' => '施術名は必須項目です',
            'duration_minutes.required' => '所要時間は必須項目です',
            'price.required' => '料金は必須項目です',
            'duration_minutes.integer' => '所要時間は整数で入力してください',
            'duration_minutes.multiple_of' => '所要時間は30分単位で入力してください',
            'price.integer' => '料金は整数で入力してください',
        ];
    }
}
