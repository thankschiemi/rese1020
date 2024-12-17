<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerStoreRequest extends FormRequest
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
            'description' => 'required|string|max:500|not_regex:/^\d+$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須です。',
            'region_id.required' => '地域は必須です。',
            'region_id.exists' => '指定された地域は存在しません。',
            'genre_id.required' => 'ジャンルは必須です。',
            'genre_id.exists' => '指定されたジャンルは存在しません。',
            'description.required' => '店舗概要は必須です。',
            'description.string' => '店舗概要は文字列で入力してください。',
            'description.max' => '店舗概要は500文字以内で入力してください。',
            'description.not_regex' => '店舗概要に数字のみは入力できません。',
            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像形式はjpeg, png, jpgのみ対応しています。',
            'image.max' => '画像の最大サイズは2MBです。',
        ];
    }
}
