<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_receptionist extends Model
{
    protected $table = 'menu_receptionists';

    protected $primaryKey = 'menuid';

    protected $fillable = [
        'itemname',
        'itemlevel',
        'parentid',
        'roleid',
        'itemorder',
        'isactive',
        'routename',
        'itemtarget',
        'icon'
    ];
}
