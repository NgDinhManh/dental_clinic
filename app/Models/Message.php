<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    protected $fillable = [
        'name',
        'sender_id',
        'reply_id',
        'phone',
        'email',
        'subject',
        'content',
        'reply',
        'created_at',
        'updated_at',
    ];

}
