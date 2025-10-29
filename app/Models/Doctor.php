<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors'; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'doctor_id'; // Khóa chính của bảng

    protected $fillable = [
        'fullname',
        'gender',
        'birthday',
        'address',
        'user_id',
        'specialization',
        'experience_years',
        'education',
        'certification',
        'license',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'doctor_id');
    }
}
