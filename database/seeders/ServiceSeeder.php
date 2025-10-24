<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'service_name' => 'Khám tổng quát',
                'description' => 'Dịch vụ khám tổng quát',
                'price' => 0,
                'duration' => '30 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 1,
            ],
            [
                'service_name' => 'Lấy cao răng',
                'description' => 'Dịch vụ lấy cao răng',
                'price' => 200000,
                'duration' => '45 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 2,
            ],
            [
                'service_name' => 'Điều trị tủy',
                'description' => 'Dịch vụ điều trị tủy',
                'price' => 1500000,
                'duration' => '90 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 3,
            ],
            [
                'service_name' => 'Hàn trám răng',
                'description' => 'Dịch vụ hàn trám răng',
                'price' => 500000,
                'duration' => '60 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 4,
            ],
            [
                'service_name' => 'Nhổ răng khôn',
                'description' => 'Dịch vụ nhổ răng khôn',
                'price' => 1000000,
                'duration' => '60 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 5,
            ],
            [
                'service_name' => 'Bọc răng sứ',
                'description' => 'Dịch vụ bọc răng sứ',
                'price' => 3000000,
                'duration' => '120 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 6,
            ],
            [
                'service_name' => 'Niềng răng mắc cài',
                'description' => 'Dịch vụ niềng răng mắc cài',
                'price' => 20000000,
                'duration' => '180 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 7,
            ],
            [
                'service_name' => 'Cấy ghép implant',
                'description' => 'Dịch vụ cấy ghép implant',
                'price' => 15000000,
                'duration' => '90 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 8,
            ],
            [
                'service_name' => 'Tẩy trắng răng tại phòng khám',
                'description' => 'Dịch vụ tẩy trắng răng tại phòng khám',
                'price' => 2500000,
                'duration' => '60 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 9,
            ],
            [
                'service_name' => 'Làm răng giả tháo lắp',
                'description' => 'Dịch vụ làm răng giả tháo lắp',
                'price' => 5000000,
                'duration' => '120 phút',
                'status' => 'Có sẵn',
                'post_id' => null,
                'image' => null,
                'category_id' => 10,
            ]
        ];
        \DB::table('services')->insertOrIgnore($data);
    }
}
