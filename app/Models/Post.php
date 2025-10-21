<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'title',
        'abstract',
        'contents',
        'images',
        'link',
        'topic',
        'author',
        'is_active',
        'post_order',
        'create_at'
    ];

    public function getImageUrlAttribute()
    {
        return $this->images ? asset('storage/images/' .  $this->images) : asset('default-image.jpg');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'post_id');
    }
}
