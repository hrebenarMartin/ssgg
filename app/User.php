<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'access_level',
    ];

    //----------------------------------------------------\\

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile', "user_id", "id");
    }

    public function contributions()
    {
        return $this->hasMany('App\Models\Contribution');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\ContributionComment');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }

}
