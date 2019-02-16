<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
