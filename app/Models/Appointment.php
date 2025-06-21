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
        return $this->belongsTo(Patient::class, 'patient_id', 'userid'); // Cột khóa ngoại là patient_id
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'userid'); // Cột khóa ngoại là patient_id
    }
}
