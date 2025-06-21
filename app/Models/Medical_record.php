<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical_record extends Model
{
    protected $table = 'medical_records';

    protected $primaryKey = 'record_id';

    public $timestamps = false;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'diagnosis',
        'treatment_plan',
        'note',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'userid');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'userid');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }
}
