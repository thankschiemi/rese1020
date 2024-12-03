<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'member_id',
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
        $user_id = Auth::id(); // ログイン中のユーザーIDを取得
        if ($user_id) {
            // 現在のレストランがユーザーのお気に入りに登録されているかを確認
            return $this->favorites()->where('member_id', $user_id)->exists();
        }
        return false; // 未ログインの場合は常に false
    }

    // お気に入り（favorites）とのリレーション
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'restaurant_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
