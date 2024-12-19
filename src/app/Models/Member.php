<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // お気に入りリレーション（例として保持）
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // 店舗代表者に関連するレストランリレーション
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'member_id');
    }

    // 予約情報リレーション
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'member_id');
    }
}
