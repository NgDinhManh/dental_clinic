<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'fullname' => 'Nguyễn Doctor',
                'gender' => 'Nam',
                'birthday' => '1980-01-30',
                'address' => 'Vinh, Nghệ An',
                'user_id' => 2,
                'specialization' => 'Bác sĩ cấy ghép implant',
                'experience_years' => 5,
                'education' => 'Thạc sĩ khoa cấy ghép implant Đại học Y Hà Nội',
                'certification' => 'image.png',
                'license' => 'image.png'
            ],
        ];
        \DB::table('doctors')->insertOrIgnore($data);
    }
}
