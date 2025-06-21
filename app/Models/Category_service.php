<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_service extends Model
{
    protected $table = 'category_services';

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'category_id');
    }
}
