<?php

namespace Database\Seeders;

use App\Models\Botol;
use App\Models\Cap;
use App\Models\Karton;
use App\Models\Label;
use App\Models\Lakban;
use App\Models\ParameterVarian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Botol::create([
            'name'=>'Bottle 350ml'
        ]);

        Cap::create([
            'name'=>'Cap Yuzu Blue'
        ]);

        Label::create([
            'name'=>'Label Yuzu Isotonic 350ml'
        ]);

        Karton::create([
            'name'=>'Karton Yuzu Isotonic 12x350ml'
        ]);

        Lakban::create([
            'name' => 'Lakban'
        ]);

        ParameterVarian::create([
            'name'=>'YUZU ISOTONIC 350 ml x 12',
        ]);

        ParameterVarian::create([
            'name'=>'YUZU ISOTONIC 485 ml x 12',
        ]);

        ParameterVarian::create([
            'name'=>'WRP COCO SPLASH 350 ml x 24',
        ]);
    }
}
