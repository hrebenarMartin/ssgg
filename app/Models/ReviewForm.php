<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewForm extends Model
{
    protected $table = 'review_forms';

    public function conference(){
        return $this->belongsTo('App\Models\Conference', 'conference_id' , 'id');
    }

    public function fills(){
        return $this->hasMany('App\Models\ReviewFormFill', "form_id", "id");
    }
}
