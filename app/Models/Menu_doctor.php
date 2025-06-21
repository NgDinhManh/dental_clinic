<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_doctor extends Model
{
    protected $table = 'menu_doctors';

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
