<?php

namespace Database\Seeders;

use App\Models\JenisSampel;
use App\Models\ParameterSampel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParameterSampelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParameterSampel::create([
            'name'=>'Temperature'
        ]);

        ParameterSampel::create([
            'name'=>'Cek Brix'
        ]);

        ParameterSampel::create([
            'name'=>'PAT'
        ]);

        ParameterSampel::create([
            'name'=>'Volume'
        ]);

        ParameterSampel::create([
            'name'=>'refrensi QC'
        ]);

        ParameterSampel::create([
            'name'=>'Sample QC / R&D Futami'
        ]);

        ParameterSampel::create([
            'name'=>'Sample (Stock Gudang)'
        ]);

        JenisSampel::create([
            'name'=>'Botol'
        ]);

        JenisSampel::create([
            'name'=>'Cap'
        ]);
    }
}
