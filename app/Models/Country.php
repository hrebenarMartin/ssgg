<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public static function getCountryName($id)
    {
        return self::find($id)->name_sk;
    }
}
