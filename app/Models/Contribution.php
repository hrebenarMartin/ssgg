<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Contribution extends Model
{
    protected $table = 'contributions';

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'abstract',
        'file',
        'created_at',
        'updated_at',
        'conference_id',
    ];

    public static function destroyContributionsOfConference($conference_id)
    {
        $contrib = self::where('conference_id', $conference_id)->get();
        foreach ($contrib as $item) {
            if (File::exists(public_path('/files/contributions/') . $item->file)) {
                File::delete(public_path('/files/contributions/') . $item->file);
            }
            self::destroy($item->id);
        }
    }

    public static function getConferenceContributionsCount($conference_id)
    {
        return self::where('conference_id', $conference_id)->count();
    }

    public static function getAllTimeContributionsCount()
    {
        return self::all()->count();
    }

    public static function getListDetail()
    {
        $res = self::join('user_profiles as up', 'up.user_id', '=', 'contributions.user_id')
            ->join('conference as conf', 'contributions.conference_id', '=', 'conf.id')
            ->select('contributions.*', 'up.first_name as author_first_name',
                'up.last_name as author_last_name', 'conf.year as conference_year')
            ->get();

        return $res;
    }


    //----------------------------------------------------\\

    public function review(){
        return $this->hasOne('App\Models\Review');
    }

    public function comments(){
        return $this->hasMany('App\Models\ContributionComment');
    }

    public function conference(){
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }

    public function author(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
