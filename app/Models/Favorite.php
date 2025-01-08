<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'member_id',
        'restaurant_id',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
