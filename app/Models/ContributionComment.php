<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContributionComment extends Model
{
    protected $table = 'contribution_comments';

    protected $fillable = [
        'user_id',
        'contribution_id',
        'comment',
    ];

    public static function getContributionComments($contr_id)
    {
        return self::join('user_profiles as up', 'contribution_comments.user_id', "=", "up.user_id")
            ->select('contribution_comments.*',
                'up.user_id as prof_id',
                'up.image as prof_img',
                'up.first_name',
                'up.middle_name',
                'up.last_name',
                'up.title_before',
                'up.title_after',
                'up.updated_at as comment_added')
            ->where('contribution_id', $contr_id)
            ->get();
    }

    //----------------------------------------------------\\

    public function author(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function contribution(){
        return $this->belongsTo('App\Models\Contribution');
    }

}
