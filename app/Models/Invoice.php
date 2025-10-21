<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'record_id',
        'receptionist_id',
        'total_amount',
        'discount',
        'other_fee',
        'other_fee_detail',
        'final_amount',
        'status',
        'payment_method',
        'created_at',
        'updated_at',
    ];

    public function medical_record()
    {
        return $this->belongsTo(Medical_record::class, 'record_id', 'record_id');
    }

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class, 'receptionist_id', 'receptionist_id');
    }
}
