<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ConferenceGallery extends Model
{
    protected $table = 'conference_images';

    public static function getConferenceGallery($conf_id)
    {
        return self::where('item_id', $conf_id)->get();
    }

    public static function deleteConferenceImage($img_id)
    {
        $image_class = new UploadImages();
        $image_class->deleteImage('conference', $img_id);
        ConferenceGallery::destroy($img_id);
    }

    public static function getAllTimePhotosCount(){
        return self::all()->count();
    }

    //----------------------------------------------------\\

    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
}
