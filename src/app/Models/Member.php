<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    /**
     * ログイン中のユーザーに関連する店舗を取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'member_id');
    }
}
