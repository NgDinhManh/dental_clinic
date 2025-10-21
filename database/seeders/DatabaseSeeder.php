<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = new Role();
        $role->role_name = 'admin';
        $role->description = 'Quản trị viên';
        $role->save();

        $role = new Role();
        $role->role_name = 'doctor';
        $role->description = 'Bác sĩ nha khoa';
        $role->save();

        $role = new Role();
        $role->role_name = 'receptionist';
        $role->description = 'Tiếp tân';
        $role->save();

        $role = new Role();
        $role->role_name = 'patient';
        $role->description = 'Bệnh nhân/ người dùng';
        $role->save();

        $user = new User();
        $user->name = 'admin';
        $user->phone = '0344518111';
        $user->password = bcrypt('123456');
        $user->role_id = 1;
        $user->save();

        $user = new User();
        $user->name = 'doctor';
        $user->phone = '0344518222';
        $user->password = bcrypt('123456');
        $user->role_id = 2;
        $user->save();

        $user = new User();
        $user->name = 'receptionist';
        $user->phone = '0344518333';
        $user->password = bcrypt('123456');
        $user->role_id = 3;
        $user->save();

        $user = new User();
        $user->name = 'patient';
        $user->phone = '0344518444';
        $user->password = bcrypt('123456');
        $user->role_id = 4;
        $user->save();
    }
}
