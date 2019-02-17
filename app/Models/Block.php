<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Block extends Model
{
    protected $table = 'page_content';


    public static function destroyBlocksOfPage($page_id)
    {
        $blocks = self::where('page_id', $page_id)->get();
        foreach ($blocks as $block){
            //TODO destroy images as well
            self::destroy($block->id);
        }
    }
}
