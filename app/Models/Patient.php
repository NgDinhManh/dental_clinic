<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'userid';

    protected $fillable = [
        'cccd',
        'bhyt',
        'blood_type',
        'allergies',
        'medical_history',
        'dental_history',
        'current_medications',
        'emergency_contact',
        'emergency_contact_phone',
        'emergency_contact_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid'); // Cột khóa ngoại là userid
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
