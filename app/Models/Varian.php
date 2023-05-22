<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{

    protected $table = 'varians';
    protected $guarded = ['id'];
    use HasFactory;


    public function parameter()
{
    return $this->belongsTo(ParameterVarian::class);
}
    public function botol()
{
    return $this->belongsTo(Botol::class);
}

    public function karton()
{
    return $this->belongsTo(Karton::class);
}

    public function cap()
{
    return $this->belongsTo(Cap::class);
}

    public function label()
{
    return $this->belongsTo(Label::class);
}

public function lakban()
{
    return $this->belongsTo(Lakban::class);
}

public function produksi()
{
    return $this->hasMany(Produksi::class);
}
}
