<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterSampel extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function sampel()
{
    return $this->hasMany(Sampel::class);
}
}
