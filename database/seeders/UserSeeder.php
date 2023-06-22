<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        User::create([
            'name' => 'ftmpro01',
            'alias'=>'ftmpro01',
            'role_id' => 3,
            'address' => 'Alburqueque',
            'email' => 'walter@gmail.com',
            'password' => bcrypt('1234567890'),
            'no_hp' => '082110859217'
        ]);

        User::create([
            'name'=>'ftmpro02',
            'alias'=>'ftmpro02', // tambahin alias di database 'users
            'role_id'=> 3,
            'address'=>'Bogor',
            'email'=>'admin@gmail.com',
            'password' => bcrypt('1234567890'),
            'no_hp'=>'1234567890'
        ]);

        User::create([
            'name'=>'ftmpro03',
            'alias'=>'ftmpro03',
            'role_id'=>3,
            'address'=>'Caringin',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('1234567890'),
            'no_hp'=>'0987654321'
        ]);

        User::create([
            'name'=>'ftmpro04',
            'alias'=>'ftmpro04',
            'role_id'=>3,
            'address'=>'Caringin',
            'email'=>'ftmpro04@gmail.com',
            'password'=>bcrypt('1234567890'),
            'no_hp'=>'0987654321'
        ]);
    }
}
