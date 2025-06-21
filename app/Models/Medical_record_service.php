<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical_record_service extends Model
{
    protected $table = 'medical_record_services';
    protected $primaryKey = 'record_id, service_id';
    public $timestamps =true;

    protected $fillable = [
        'record_id',
        'service_id',
    ];

    public function medical_record()
    {
        return $this->belongsTo(Medical_record::class, 'record_id', 'record_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}
