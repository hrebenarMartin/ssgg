<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable =[
        'title',
        'alias',
    ];

    public static function getHomePage(){
        $res = DB::table('pages')
            ->where('alias', 'home')
            ->first();

        return $res;
    }
}
