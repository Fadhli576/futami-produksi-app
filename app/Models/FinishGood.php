<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishGood extends Model
{
    protected $guarded = ['id'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    use HasFactory;
}
