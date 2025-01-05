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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'member_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'member_id');
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        return $this->save();
    }

    public function getEmailForVerification()
    {
        return $this->email;
    }
}
