<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable =[
        'title',
        'title_second',
        'description',
        'module',
        'alias',
        'conference_id',
        'active',
    ];


    public static function destroyPagesOfConference($conference_id)
    {
        $pages = self::where('module', 2)->where('conference_id', $conference_id)->get();
        foreach ($pages as $p){
            Block::destroyBlocksOfPage($p->id);
            self::destroy($p->id);
        }
    }

    public static function disablePagesOfConference($conference_id)
    {
        self::where('conference_id', $conference_id)->update(['active' => 0]);
    }

    public static function enablePagesOfConference($conference_id)
    {
        self::where('conference_id', $conference_id)->update(['active' => 1]);
    }

    //----------------------------------------------------\\

    public function blocks(){
        return $this->hasMany('App\Models\Block');
    }
}
