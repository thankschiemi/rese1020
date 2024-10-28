<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    // restaurantsテーブルに対応するモデルであることを指定（省略可能）
    protected $table = 'restaurants';

    // 複数代入可能な属性を指定（fillable）
    protected $fillable = [
        'name',
        'region_id',
        'genre_id',
        'description',
        'image_url',
    ];

    // 地域（region）とのリレーション
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // ジャンル（genre）とのリレーション
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
