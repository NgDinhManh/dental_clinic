<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    protected $table = 'receptionists'; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'userid'; // Khóa chính của bảng

    public $incrementing = false; // Không tự động tăng (vì dùng userid làm khóa chính)

    protected $fillable = [
        'start_date',
        'shift',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid'); // Cột khóa ngoại là userid
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'receptionist_id', 'userid');
    }
}
