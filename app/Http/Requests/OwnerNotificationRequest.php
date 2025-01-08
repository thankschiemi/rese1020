<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名は必須です。',
            'message.required' => 'メッセージは必須です。',
            'message.max' => 'メッセージは1000文字以内で入力してください。',
        ];
    }
}
