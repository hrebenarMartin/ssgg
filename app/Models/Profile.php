<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'title_before',
        'title_after',
        'gender',
        'birthday',
        'workplace',
        'address_street',
        'address_city',
        'address_psc',
        'address_country',
        'ico',
        'dic',
        'phone',
        'image',
    ];

    protected function user(){
        return $this->belongsTo('App\User', "user_id", "id");
    }
}
