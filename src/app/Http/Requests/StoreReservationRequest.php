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
            'number' => 'required|integer|min:1',
            'restaurant_id' => 'required|exists:restaurants,id',
            'member_id' => 'required|exists:members,id',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を選択してください。',
            'date.after_or_equal' => '予約日には、今日以降の日付を選択してください。',
            'time.required' => '時間を選択してください。',
            'number.required' => '人数を選択してください。',
            'number.min' => '最低人数は1人です。',
        ];
    }
}
