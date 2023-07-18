<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function batchList()
    {
        return $this->hasOne(BatchList::class, 'batch_id');
    }
}
