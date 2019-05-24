<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewFormFill extends Model
{
    protected $table = 'review_form_fills';

    public function form(){
        return $this->belongsTo('App\Models\ReviewForm',"form_id", "id");
    }
}
