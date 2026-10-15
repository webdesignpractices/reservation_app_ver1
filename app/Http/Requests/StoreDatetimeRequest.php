<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDatetimeRequest extends FormRequest
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

            //日時（必須、未来の日時など）
            'date' => ['required', 'date'],
            'time' => ['required'],
        ];
    }
    public function messages(){
        return [
            'date.required' => '予約日時を選択してください',
            'time.required' => '予約日時を選択してください',
        ];
    }
}
