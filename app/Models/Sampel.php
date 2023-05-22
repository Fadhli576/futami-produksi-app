<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function tempatSampel()
    {
        return $this->belongsTo(TempatReject::class, 'id_tempat_sampel');
    }

    public function parameterSampel()
    {
        return $this->belongsTo(ParameterSampel::class, 'id_paramater_sampel');
    }

    public function spesifikSampel()
    {
        return $this->belongsTo(SpesifikTempat::class, 'id_spesifik_tempat');
    }

    public function jenisSampel()
    {
        return $this->belongsTo(JenisSampel::class, 'id_jenis_sampel');
    }
}
