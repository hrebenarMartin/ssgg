<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontMenu extends Model
{
    protected $table = 'front_menu';

    protected $fillable = [
        'name_sk',
        'name_en',
        'route',
        'rank',
        'module',
        'updated_at',
        'created_at'
    ];
}
