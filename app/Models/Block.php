<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Block extends Model
{
    protected $table = 'page_content';

    public static function getPageBlocks($page_id){
        $res = DB::table('page_content')
            ->where('page_id', $page_id)
            ->get();

        return $res;
    }
}
