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
            if(File::exists(public_path('/files/contributions/').$item->file)){
                File::delete(public_path('/files/contributions/').$item->file);
            }
            self::destroy($item->id);
        }
    }
}
