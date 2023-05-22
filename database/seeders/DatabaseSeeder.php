<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ParameterRejectSeeder::class);
        $this->call(RejectSeeder::class);
        $this->call(ParameterSampelSeeder::class);
        $this->call(VarianSeeder::class);
    }
}
