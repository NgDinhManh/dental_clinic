<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'email',
        'subject',
        'message',
        'reply',
        'created_at',
        'updated_at',
    ];

}
