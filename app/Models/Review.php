<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'restaurant_id',
        'member_id',
        'rating',
        'comment',
    ];

    // リレーション
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
