<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";

    protected $fillable = [
        'user_id',
        'contribution_id',
        'accepted',
        'rating',
        'review',
        'approved',
    ];

    public function reviewer(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function contribution(){
        return $this->belongsTo('App\Models\Contribution');
    }

    public function form_fill(){
        return $this->hasOne('App\Models\ReviewFormFill', 'id', 'form_fill_id');
    }

    public function assigner(){
        return $this->belongsTo('App\User', 'assigned_by');
    }
}
