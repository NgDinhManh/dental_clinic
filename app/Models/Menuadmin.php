<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menuadmin extends Model
{
    protected $table = 'menuadmins';

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
