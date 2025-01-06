<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerUpdateStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'image_url' => [
                'nullable',
                'regex:/^(https?:\/\/|images\/)[a-zA-Z0-9._\/-]+$/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須です。',
            'region_id.required' => '地域は必須です。',
            'genre_id.required' => 'ジャンルは必須です。',
            'image_url.regex' => '画像URLは「http(s)://」または「images/」で始まる形式である必要があります。',
        ];
    }
}
