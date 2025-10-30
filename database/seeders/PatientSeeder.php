<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'fullname' => 'Nguyễn Bệnh Nhân',
                'gender' => 'Nam',
                'birthday' => '1985-01-30',
                'address' => 'Vinh Phú, Nghệ An',
                'user_id' => 4,
            ],
        ];
        \DB::table('patients')->insertOrIgnore($data);
    }
}
