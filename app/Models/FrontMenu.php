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
        'created_at',
        'active',
        'conference_id',
    ];

    public static function destroyMenuOfConference($conference_id)
    {
        $menu_items = self::where('module', 2)->where('conference_id', $conference_id)->get();
        foreach ($menu_items as $item) self::destroy($item->id);

    }

    public static function disableMenuOfConference($conference_id)
    {
        self::where('conference_id',$conference_id)->update(['active' => 0]);
    }

    public static function enableMenuOfConference($conference_id)
    {
        self::where('conference_id',$conference_id)->update(['active' => 1]);
    }
}
