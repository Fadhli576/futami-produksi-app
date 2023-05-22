<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterReject extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    public function reject()
{
    return $this->hasMany(Reject::class);
}
}
