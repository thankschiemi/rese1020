<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'member_id',
        'restaurant_id',
        'reservation_date',
        'reservation_time',
        'number_of_people',
    ];

    public $timestamps = true;

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('member_id', $userId);
    }

    public function generateQrData()
    {
        return "予約情報:\n"
            . "店舗名: {$this->restaurant->name}\n"
            . "日時: {$this->reservation_date} {$this->reservation_time}\n"
            . "人数: {$this->number_of_people}人";
    }
}
