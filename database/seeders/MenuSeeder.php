<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'menu_name' => 'Trang chủ',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => '/',
                'is_active' => 1,
                'menu_order' => 1,
                'position' => 1,
            ],
            [
                'menu_name' => 'Giới thiệu',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'home/about',
                'is_active' => 1,
                'menu_order' => 2,
                'position' => 1,
            ],
            [
                'menu_name' => 'Dịch vụ',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'home/service',
                'is_active' => 1,
                'menu_order' => 3,
                'position' => 1,
            ],
            [
                'menu_name' => 'Đặt lịch khám',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'home/appointment',
                'is_active' => 1,
                'menu_order' => 4,
                'position' => 1,
            ],
            [
                'menu_name' => 'Liên hệ',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'home/contact',
                'is_active' => 1,
                'menu_order' => 5,
                'position' => 1,
            ],
            [
                'menu_name' => 'Bài viết',
                'level' => 1,
                'parent_id' => 0,
                'route_name' => 'home/post',
                'is_active' => 1,
                'menu_order' => 6,
                'position' => 2,
            ],
            [
                'menu_name' => 'Tin tức, sự kiện',
                'level' => 2,
                'parent_id' => 6,
                'route_name' => 'home/post-event',
                'is_active' => 1,
                'menu_order' => 1,
                'position' => 1,
            ],
            [
                'menu_name' => 'Kiến thức nha khoa',
                'level' => 2,
                'parent_id' => 6,
                'route_name' => 'home/post-knowledge',
                'is_active' => 1,
                'menu_order' => 2,
                'position' => 1,
            ],
            [
                'menu_name' => 'Bài viết dịch vụ',
                'level' => 2,
                'parent_id' => 6,
                'route_name' => 'home/post-service',
                'is_active' => 1,
                'menu_order' => 3,
                'position' => 1,
            ],
        ];

        \DB::table('menus')->insertOrIgnore($data);
    }
}
