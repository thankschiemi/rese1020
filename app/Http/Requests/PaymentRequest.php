<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payment_method_id' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'payment_method_id.required' => '支払い方法が無効です。',
        ];
    }
}
