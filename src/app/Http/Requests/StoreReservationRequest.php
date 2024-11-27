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
            'datetime' => 'nullable|date|after:now',
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
            'number.integer' => '人数は数字で入力してください。',
            'datetime.after' => '現在の日時以降を選択してください。',
        ];
    }

    protected function prepareForValidation()
    {
        // 入力された日付と時間を結合して datetime を作成
        $this->merge([
            'datetime' => $this->input('date') . ' ' . $this->input('time') . ':00',
        ]);
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $datetime = $this->input('datetime');

            // 現在の日時より前の場合はエラーを追加
            if (strtotime($datetime) < strtotime('now')) {
                $validator->errors()->add('time', '現在の日時以降を選択してください。');
            }
        });
    }
}
