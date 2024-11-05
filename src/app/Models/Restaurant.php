<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurants';

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

    // お気に入り状態を取得するアクセサ
    public function getIsFavoriteAttribute()
    {
        $user_id = 1; // 仮のユーザーIDでテスト
        // 現在のレストランがユーザーのお気に入りに登録されているかを確認
        return Favorite::where('member_id', $user_id)->where('restaurant_id', $this->id)->exists();
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'restaurant_id');
    }
}
