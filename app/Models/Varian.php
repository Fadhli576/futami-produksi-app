<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
 
    protected $table = 'varians';
    protected $guarded = ['id'];
    use HasFactory;
}
