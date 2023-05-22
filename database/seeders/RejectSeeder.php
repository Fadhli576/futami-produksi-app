<?php

namespace Database\Seeders;

use App\Models\Density;
use App\Models\JenisReject;
use App\Models\ParameterReject;
use App\Models\Reject;
use App\Models\SpesifikTempat;
use App\Models\TempatReject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RejectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reject = new Reject;

        JenisReject::create([
            'name'=>'Botol'
        ]);

        JenisReject::create([
            'name'=>'Cap'
        ]);

        TempatReject::create([
            'name'=>'Inspect Lamp'
        ]);

        TempatReject::create([
            'name'=>'Cooling Tunnel'
        ]);

        TempatReject::create([
            'name'=>'Conveyor'
        ]);

        SpesifikTempat::create([
            'name'=>'Produksi'
        ]);

        SpesifikTempat::create([
            'name'=>'HCI'
        ]);

        Density::create([
            'name'=>'1,030',
            'spesifikasi'=>'spesifikasi'
        ]);

    }
}
