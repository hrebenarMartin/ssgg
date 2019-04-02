<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $table = 'conference';

    protected $fillable = [
        'title_sk',
        'title_en',
        'status',
        'year',
        'volume',
        'lat',
        'lng',
        'address_city',
        'address_country',
        'address_place',
        'registration_start',
        'registration_end',
        'conference_end',
        'conference_start',
        'proceedings_file',
        'updated_at',
        'created_at',
        'schedule_sk',
        'schedule_en',
    ];

    public static function getAllTimeConferenceCount(){
        return self::all()->count();
    }

    //----------------------------------------------------\\

    public function contributions(){
        return $this->hasMany('App\Models\Contributions');
    }

    public function config(){
        return $this->hasOne('App\Models\ConferenceConfiguration');
    }

    public function gallery(){
        return $this->hasMany('App\Models\ConferenceGallery');
    }
}
