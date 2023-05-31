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
            'name' => 'Walter White',
            'role_id' => 3,
            'address' => 'Alburqueque',
            'email' => 'walter@gmail.com',
            'password' => bcrypt('walter123'),
            'no_hp' => '082110859217'
        ]);

        User::create([
            'name'=>'admin',
            'role_id'=> 2,
            'address'=>'Bogor',
            'email'=>'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'no_hp'=>'1234567890'
        ]);

        User::create([
            'name'=>'user',
            'role_id'=>1,
            'address'=>'Caringin',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('user123'),
            'no_hp'=>'0987654321'
        ]);
    }
}
