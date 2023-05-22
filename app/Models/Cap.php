<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cap extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    public function varian()
    {
        return $this->hasMany(Varian::class);
    }
}
