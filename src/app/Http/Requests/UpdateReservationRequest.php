<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 必要に応じて認可ロジックを追加
    }

    public function rules()
    {
        return [
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '日付を選択してください。',
            'reservation_date.after_or_equal' => '過去の日付を選択することはできません。',
            'reservation_time.required' => '時間を選択してください。',
            'number_of_people.required' => '人数を選択してください。',
        ];
    }
}
