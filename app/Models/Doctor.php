<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors'; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'userid'; // Khóa chính của bảng

    public $incrementing = false; // Không tự động tăng (vì dùng userid làm khóa chính)

    protected $fillable = [
        'specialization',
        'experience_years',
        'education',
        'certification',
        'license',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid'); // Cột khóa ngoại là userid
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
