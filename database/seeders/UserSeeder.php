<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
                'phone' => '0344518111',
                'password' => bcrypt('123456'),
                'role_id' => 1,
            ],
            [
                'name' => 'doctor',
                'phone' => '0344518222',
                'password' => bcrypt('123456'),
                'role_id' => 2,
            ],
            [
                'name' => 'receptionist',
                'phone' => '0344518333',
                'password' => bcrypt('123456'),
                'role_id' => 3,
            ],
            [
                'name' => 'patient',
                'phone' => '0344518444',
                'password' => bcrypt('123456'),
                'role_id' => 4,
            ]
        ];

        \DB::table('users')->insertOrIgnore($data);
    }
}
