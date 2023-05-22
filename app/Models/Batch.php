<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function batchList()
    {
        return $this->hasMany(BatchList::class);
    }
}
