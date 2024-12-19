<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';
    protected $fillable = ['name'];

    // レストランとのリレーション
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'genre_id');
    }
}
