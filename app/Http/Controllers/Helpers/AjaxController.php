<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    public function __construct()
    {

    }

    public function main(Request $request)
    {
        //delete proceedings file
        if(isset($request->action) && strcmp($request->action, "delete_proceedings_file") == 0 ){
            Log::info("Ajax call - delete proceedings file");

            $conference = Conference::find($request->conf_id);

            $file_path = public_path('/files/conference_proceedings/');

            $file_name = $conference->proceedings_file;

            if(File::exists($file_path.$file_name)){
                File::delete($file_path.$file_name);
            }

            $conference->proceedings_file = null;
            $conference->save();

            return  response()->json(['status' => 'OK']);
        }
    }
}
