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
            'card_name'   => 'required|string|max:255',
            'card_number' => 'required|digits_between:13,16',
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'cvc'         => 'required|digits_between:3,4',
        ];
    }

    public function messages()
    {
        return [
            'card_name.required'   => 'カード名義人を入力してください。',
            'card_number.required' => 'カード番号を入力してください。',
            'card_number.digits_between' => 'カード番号は13～16桁で入力してください。',
            'expiry_date.required' => '有効期限を入力してください。',
            'expiry_date.regex'    => '有効期限はMM/YYの形式で入力してください。',
            'cvc.required'         => 'セキュリティコードを入力してください。',
            'cvc.digits_between'   => 'セキュリティコードは3～4桁で入力してください。',
        ];
    }
}
