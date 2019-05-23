<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadImages extends Model
{
    protected $fillable = [
        'name', 'path', 'ext', 'module'
    ];

    public function processImages($files, $module, $id, $name)
    {
        $image_types = Config::get('image_type.default');

        $module = str_slug(trim($module));
        $name = str_replace('_', '-', $name);
        $name = str_slug(str_limit($name, 60, ''));

        $filePath = public_path('/images/' . $module . '/' . $id);
        if (File::isDirectory($filePath) or File::makeDirectory($filePath, 0777, true, true)) ;

        foreach ($files as $File_key => $file) {

            if (!$file || !$file->isValid()) continue;

            $fileName = $name . '-' . mt_rand();
            $fileName = strtolower($fileName);
            $fileExtension = '.' . strtolower($file->getClientOriginalExtension());

            $fileToDb = $fileName . $fileExtension;

            if ($image_types) {
                foreach ($image_types as $key => $image_type) {

                    if (strlen($key) > 0) {
                        if (File::isDirectory($filePath . '/' . $key) or
                            File::makeDirectory($filePath . '/' . $key, 0777, true, true)) ;
                    }

                    if (strcmp($image_type['greyscale'], 'yes')) {
                        $img = Image::make($file);
                    } else {
                        $img = Image::make($file)->greyscale()->brightness($image_type['brightness']);
                    }

                    if (strcmp($image_type['crop'], 'no') == 0) {
                        $img->resize($image_type['width'], $image_type['height'], function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    } else {
                        $img->fit($image_type['width'], $image_type['height'], function ($constraint) {
                            $constraint->upsize();
                        });
                    }

                    $img->save($filePath . '/' . $key . '/' . $fileToDb);
                }
            }

            $data_db['image'] = $fileToDb;
            $data_db['item_id'] = $id;
            $data_db['mime'] = $file->getMimeType();
            $data_db['ext'] = $fileExtension;
            $data_db['alt_name'] = "";
            $data_db['created_at'] = Carbon::now();

            DB::table('conference_images')->insert($data_db);

            $json[] = array(
                'name' => $fileToDb,
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
                'url' => asset('/images') . '/' . $module . '/' . $id . '/' . $fileToDb,
                'thumbnailUrl' => asset('/images') . '/' . $module . '/' . $id . '/sq/' . $fileToDb,
            );
        }

        return $json;
    }

    public function deleteImage($module, $id, $id_module = null)
    {
        if (strcmp($module, 'user') == 0) {

            $user = User::findOrFail($id);
            $file = $user->image;

        } elseif (strcmp($module, 'block-images') == 0) {
            $file = DB::table('page_content_images')->where('id', $id)->value('image');
        } elseif (strcmp($module, 'conference') == 0) {
            $img = ConferenceGallery::find($id);
            $file = $img->image;
            $id = $img->item_id;
        }

        if ($file) {
            $path_module = public_path('/images/' . $module . '/' . $id);

            File::delete($path_module . '/' . $file);

            if (File::isDirectory($path_module)) {
                foreach (File::directories($path_module) as $dir) {
                    File::delete($dir . '/' . $file);
                }
            }
            return $path_module . $file;
        }
    }
}
