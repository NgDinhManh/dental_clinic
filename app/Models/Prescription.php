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

    public function medicalRecord()
    {
        return $this->belongsTo(Medical_record::class, 'record_id', 'record_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'userid');
    }
}
