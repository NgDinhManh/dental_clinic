<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'role_name' => 'admin',
                'description' => 'Quản trị viên',
            ],
            [
                'role_name' => 'doctor',
                'description' => 'Bác sĩ nha khoa',
            ],
            [
                'role_name' => 'receptionist',
                'description' => 'Tiếp tân',
            ],
            [
                'role_name' => 'patient',
                'description' => 'Bệnh nhân/ người dùng',
            ]
        ];

    \DB::table('roles')->insertOrIgnore($data);
    }
}
