<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_admin extends Model
{
    protected $table = 'menu_admins';

    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_name',
        'level',
        'parent_id',
        'menu_order',
        'is_active',
        'route_name',
        'menu_target',
        'icon',
        'created_at',
        'updated_at',
    ];
}
