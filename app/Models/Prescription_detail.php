<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription_detail extends Model
{
    protected $table = 'prescription_details';

    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'prescription_id',
        'medicine_name',
        'dosage',
        'quantity',
        'instruction',
        'created_at',
        'updated_at'
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id', 'prescription_id');
    }
}
