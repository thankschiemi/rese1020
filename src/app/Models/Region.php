<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory; // HasFactoryを追加（オプション）

    protected $fillable = ['name'];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'region_id');
    }
}
