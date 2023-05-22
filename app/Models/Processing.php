<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processing extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

     public function density()
{
    return $this->belongsTo(Density::class);
}
}
