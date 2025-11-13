<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'status',
        'service_id',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    public function appointment_services()
    {
        return $this->hasMany(Appointment_service::class, 'appointment_id', 'appointment_id');
    }
}
