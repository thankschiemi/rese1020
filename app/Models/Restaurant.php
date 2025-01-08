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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function getIsFavoriteAttribute()
    {
        $user_id = Auth::id();
        if ($user_id) {
            return $this->favorites()->where('member_id', $user_id)->exists();
        }
        return false;
    }

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
