<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'menu_name' => 'Bệnh nhân',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'receptionist/patient',
                'is_active' => 1,
                'menu_order' => 1,
                'menu_target' => 'patient',
                'icon' => 'fa fa-user-injured',
            ],
            [
                'menu_name' => 'Danh sách bệnh nhân',
                'level' => 2,
                'parent_id' => 1,
                'route_name' => 'receptionist/patient',
                'is_active' => 1,
                'menu_order' => 2,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Lịch khám',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'receptionist/appointment',
                'is_active' => 1,
                'menu_order' => 3,
                'menu_target' => 'appointment',
                'icon' => 'fa fa-calendar-check',
            ],
            [
                'menu_name' => 'Đặt lịch khám',
                'level' => 2,
                'parent_id' => 3,
                'route_name' => 'receptionist/appointment/create',
                'is_active' => 1,
                'menu_order' => 4,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Danh sách lịch khám',
                'level' => 2,
                'parent_id' => 3,
                'route_name' => 'receptionist/appointment',
                'is_active' => 1,
                'menu_order' => 5,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Hóa đơn',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'receptionist/invoice',
                'is_active' => 1,
                'menu_order' => 6,
                'menu_target' => 'invoice',
                'icon' => 'fa fa-file-invoice-dollar',
            ],
            [
                'menu_name' => 'Danh sách hóa đơn',
                'level' => 2,
                'parent_id' => 6,
                'route_name' => 'receptionist/invoice',
                'is_active' => 1,
                'menu_order' => 7,
                'menu_target' => null,
                'icon' => null,
            ]
        ];

        \DB::table('menu_receptionists')->insertOrIgnore($data);
    }
}
