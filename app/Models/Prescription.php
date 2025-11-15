<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';

    protected $primaryKey = 'prescription_id';

    protected $fillable = [
        'record_id',
        'doctor_id',
        'notes',
        'created_at',
        'updated_at'
    ];

    public function medical_record()
    {
        return $this->belongsTo(Medical_record::class, 'record_id', 'record_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    public function prescription_details()
    {
        return $this->hasMany(Prescription_detail::class, 'prescription_id', 'prescription_id');
    }
}
