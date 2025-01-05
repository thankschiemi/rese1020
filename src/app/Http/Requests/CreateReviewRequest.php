<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reservation_id' => 'required|exists:reservations,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'reservation_id.required' => '予約IDが必要です。',
            'reservation_id.exists' => '有効な予約IDを選択してください。',
            'restaurant_id.required' => '店舗IDが必要です。',
            'restaurant_id.exists' => '有効な店舗IDを選択してください。',
            'rating.required' => '評価を選択してください。',
            'rating.in' => '評価は選択肢から選んでください。',
            'comment.string' => 'コメントは文字列で入力してください。',
            'comment.max' => 'コメントは1000文字以内で入力してください。',
        ];
    }
}
