<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //メニュー（配列かつ最低一つは必要）
            'service_ids' => ['required' , 'array', 'min:1'],
            'service_ids.*' => ['integer' , 'exists:services,id'],

            //スタッフ（必須）
            'staff_id' => ['required', 'integer', 'exists:staff,id'],

            //日時（必須、未来の日時など）
            'date' => ['required', 'date'],
            'time' => ['required'],
        ];
    }
    public function message(): array{
        
    }
}
