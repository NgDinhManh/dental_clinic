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
        'appointment_id',
        'symptoms',
        'diagnosis',
        'treatment_plan',
        'note',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }

    public function medical_record_services()
    {
        return $this->hasMany(Medical_record_service::class, 'record_id', 'record_id');
    }
}
