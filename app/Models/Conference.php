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
        return $this->hasMany('App\Models\Contribution');
    }

    public function config(){
        return $this->hasOne('App\Models\ConferenceConfiguration');
    }

    public function gallery(){
        return $this->hasMany('App\Models\ConferenceGallery', 'item_id');
    }

    public function country(){
        return $this->hasOne('App\Models\Country', 'id' ,'address_country');
    }

    public function applications(){
        return $this->hasMany('App\Models\Application');
    }

    public function review_form(){
        return $this->hasOne('App\Models\ReviewForm', 'conference_id');
    }
}

