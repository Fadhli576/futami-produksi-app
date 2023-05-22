<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    public function tempatReject()
    {
        return $this->belongsTo(TempatReject::class, 'id_tempat_reject');
    }

    public function parameterReject()
    {
        return $this->belongsTo(ParameterReject::class, 'id_paramater_reject');
    }

    public function spesifikTempat()
    {
        return $this->belongsTo(SpesifikTempat::class, 'id_spesifik_tempat');
    }

    public function jenisReject()
    {
        return $this->belongsTo(JenisReject::class, 'id_jenis_reject');
    }
}
