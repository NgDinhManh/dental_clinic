<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'fullname' => 'Nguyễn Tiếp Tân',
                'gender' => 'Nữ',
                'birthday' => '1990-01-30',
                'address' => 'Cửa Lò, Nghệ An',
                'user_id' => 3,
                'start_date' => '2025-01-20',
                'shift' => 'Sáng',
            ],
        ];
        \DB::table('receptionists')->insertOrIgnore($data);
    }
}
