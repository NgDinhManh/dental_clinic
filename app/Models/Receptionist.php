<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    protected $table = 'receptionists'; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'receptionist_id'; // Khóa chính của bảng

    protected $fillable = [
        'fullname',
        'gender',
        'birthday',
        'address',
        'user_id',
        'start_date',
        'shift',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'receptionist_id', 'receptionist_id');
    }
}
