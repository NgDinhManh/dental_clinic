<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_name',
        'description',
        'price',
        'duration',
        'status',
        'postid',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category_service::class, 'category_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postid');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/images/services/' . $this->image) : asset('default-image.jpg');
    }
}
