<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'receiver_id',
        'title',
        'content',
        'is_read',
        'is_deleted',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'user_id');
    }
}
