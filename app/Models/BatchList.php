<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchList extends Model
{
    protected $table = 'batch_lists';
    protected $guarded = ['id'];
    use HasFactory;

    public function produksi()
    {
        return $this->hasMany(Produksi::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}

