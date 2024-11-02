<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'favorites';

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'restaurant_id',
    ];

    /**
     * Memberモデルとのリレーション (多対一)
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Restaurantモデルとのリレーション (多対一)
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
