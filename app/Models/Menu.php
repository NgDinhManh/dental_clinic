<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_name',
        'is_active',
        'level',
        'parent_id',
        'route_name',
        'link',
        'menu_order',
        'position'
    ];

}
