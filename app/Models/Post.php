<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'postid';

    protected $fillable = [
        'title',
        'abstract',
        'contents',
        'images',
        'link',
        'topic',
        'author',
        'isactive',
        'postorder',
        'create_at'
    ];

    public function getImageUrlAttribute()
    {
        return $this->images ? asset('storage/images/' .  $this->images) : asset('default-image.jpg');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'postid');
    }
}
