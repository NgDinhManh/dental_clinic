<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'menu_name' => 'Lịch làm việc',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'doctor/lich-lam-viec/lich-kham',
                'is_active' => 1,
                'menu_order' => 1,
                'menu_target' => 'work_schedule',
                'icon' => 'fa fa-calendar-check',
            ],
            [
                'menu_name' => 'Lịch khám hôm nay',
                'level' => 2,
                'parent_id' => 1,
                'route_name' => 'doctor/lich-lam-viec/lich-kham-hom-nay',
                'is_active' => 1,
                'menu_order' => 2,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Tất cả lịch khám',
                'level' => 2,
                'parent_id' => 1,
                'route_name' => 'doctor/lich-lam-viec/lich-kham',
                'is_active' => 1,
                'menu_order' => 3,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Bệnh nhân',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'doctor/benh-nhan/benh-nhan',
                'is_active' => 1,
                'menu_order' => 4,
                'menu_target' => 'patient',
                'icon' => 'fa fa-user-injured',
            ],
            [
                'menu_name' => 'Danh sách bệnh nhân',
                'level' => 2,
                'parent_id' => 4,
                'route_name' => 'doctor/benh-nhan/benh-nhan',
                'is_active' => 1,
                'menu_order' => 5,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Bệnh nhân từng khám',
                'level' => 2,
                'parent_id' => 4,
                'route_name' => 'doctor/benh-nhan/benh-nhan-tung-kham',
                'is_active' => 1,
                'menu_order' => 6,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Hồ sơ bệnh án',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'doctor/benh-an/benh-an',
                'is_active' => 1,
                'menu_order' => 7,
                'menu_target' => 'medical_record',
                'icon' => 'fa fa-file-medical',
            ],
            [
                'menu_name' => 'Tất cả bệnh án',
                'level' => 2,
                'parent_id' => 7,
                'route_name' => 'doctor/benh-an/benh-an',
                'is_active' => 1,
                'menu_order' => 8,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Đang điều trị',
                'level' => 2,
                'parent_id' => 7,
                'route_name' => 'doctor/benh-an/benh-an-dang-dieu-tri',
                'is_active' => 1,
                'menu_order' => 9,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Đã hoàn thành',
                'level' => 2,
                'parent_id' => 7,
                'route_name' => 'doctor/benh-an/benh-an-hoan-tat',
                'is_active' => 1,
                'menu_order' => 10,
                'menu_target' => null,
                'icon' => null,
            ],
            [
                'menu_name' => 'Đơn thuốc',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'doctor/don-thuoc/don-thuoc',
                'is_active' => 1,
                'menu_order' => 11,
                'menu_target' => 'prescription',
                'icon' => 'fa fa-prescription-bottle-alt',
            ],
            [
                'menu_name' => 'Danh sách đơn thuốc',
                'level' => 2,
                'parent_id' => 11,
                'route_name' => 'doctor/don-thuoc/don-thuoc',
                'is_active' => 1,
                'menu_order' => 12,
                'menu_target' => null,
                'icon' => null,
            ]
        ];
        \DB::table('menu_doctors')->insertOrIgnore($data);
    }
}
