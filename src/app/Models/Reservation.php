<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations'; // テーブル名の指定

    protected $fillable = [
        'member_id',
        'restaurant_id',
        'reservation_date',
        'reservation_time',
        'number_of_people',
    ];

    public $timestamps = true;

    // 会員（ユーザー）とのリレーション
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // レストランとのリレーション
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    // スコープ: ログイン中のユーザーの予約を取得
    public function scopeForUser($query, $userId)
    {
        return $query->where('member_id', $userId);
    }

    // QRコードデータを生成するメソッド
    public function generateQrData()
    {
        return "予約情報:\n"
            . "店舗名: {$this->restaurant->name}\n"
            . "日時: {$this->reservation_date} {$this->reservation_time}\n"
            . "人数: {$this->number_of_people}人";
    }
}
