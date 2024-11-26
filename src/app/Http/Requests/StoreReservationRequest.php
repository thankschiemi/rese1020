<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'number' => 'required|integer|min:1|max:10',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を選択してください。',
            'date.date' => '有効な日付を入力してください。',
            'date.after_or_equal' => '過去の日付を選択することはできません。',
            'time.required' => '時間を選択してください。',
            'number.required' => '人数を選択してください。',
        ];
    }
}
