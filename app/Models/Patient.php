<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'patient_id';

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
        return $this->belongsTo(User::class, 'patient_id', 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'patient_id');
    }
}
