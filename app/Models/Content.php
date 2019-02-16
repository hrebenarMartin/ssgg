<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'page_content';

    protected $fillable = [
        'page_id',
        'type',
        'content',
        'rank',
        'title',
        'content_en',
    ];
}
