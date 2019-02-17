<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceConfiguration extends Model
{
    protected $table = 'conference_config';

    protected $fillable =[
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
        'special_1_sk',
        'special_1_en',
        'special_2',
        'special_2_sk',
        'special_2_en',
        'special_3',
        'special_3_sk',
        'special_3_en',
        'accom_1',
        'accom_1_price',
        'accom_2',
        'accom_2_price',
        'accom_3',
        'accom_3_price',
        'accom_4',
        'accom_4_price',
        'accom_5',
        'accom_5_price',
        'extra_info_sk',
        'extra_info_en',
        'created_at',
        'updated_at',
    ];

    public static function destroyConfigOfConference($conference_id)
    {
        $id = self::where('conference_id', $conference_id)->first()->id;
        self::destroy($id);
    }
}
