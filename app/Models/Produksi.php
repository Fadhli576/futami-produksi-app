<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function varian()
    {
        return $this->belongsTo(Varian::class);
    }

    public function batchList()
    {
        return $this->belongsTo(BatchList::class);
    }

}
