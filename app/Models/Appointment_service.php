<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment_service extends Model
{
    protected $table = 'appointment_services';
    protected $primaryKey = 'appointment_id, service_id';
    public $timestamps = true;

    protected $fillable = [
        'appointment_id',
        'service_id',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}
