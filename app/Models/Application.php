<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'user_id',
        'conference_id',

        'day1_breakfast',
        'day1_lunch',
        'day1_dinner',
        'day2_breakfast',
        'day2_lunch',
        'day2_dinner',
        'day3_breakfast',
        'day3_lunch',
        'day3_dinner',
        'day4_breakfast',
        'day4_lunch',
        'day4_dinner',
        'day5_breakfast',
        'day5_lunch',
        'day5_dinner',

        'special_1',
        'special_2',
        'special_3',

        'accom_1',
        'accom_2',
        'accom_3',
        'accom_4',
        'accom_5',

        'extra',

        'status',

        'created_at',
        'updated_at',
    ];
}
