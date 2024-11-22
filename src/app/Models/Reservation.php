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
        return $this->belongsTo(Member::class);
    }

    // レストランとのリレーション
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
