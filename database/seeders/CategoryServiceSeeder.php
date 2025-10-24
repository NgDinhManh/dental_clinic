<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'category_name' => 'Tổng quát',
                'description' => 'Dịch vụ tổng quát',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Điều trị nha chu',
                'description' => 'Dịch vụ điều trị nha chu',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Điều trị nội nha',
                'description' => 'Dịch vụ điều trị nội nha',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Trám răng',
                'description' => 'Dịch vụ trám răng',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Nhổ răng',
                'description' => 'Dịch vụ nhổ răng',
                'status' => 'Có sẵn',
            ],
            [
                'catedory_name' => 'Răng sứ',
                'description' => 'Dịch vụ răng sứ',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Niềng răng',
                'description' => 'Dịch vụ niềng răng',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Cấy ghép implant',
                'description' => 'Dịch vụ cấy ghép implant',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Tẩy trắng răng',
                'description' => 'Dịch vụ tẩy trắng răng',
                'status' => 'Có sẵn',
            ],
            [
                'category_name' => 'Răng giả tháo lắp',
                'description' => 'Dịch vụ răng giả tháo lắp',
                'status' => 'Có sẵn',
            ],


        ];
        \DB::table('category_services')->insertOrIgnore($data);
    }
}
