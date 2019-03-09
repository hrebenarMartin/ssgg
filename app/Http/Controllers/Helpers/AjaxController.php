<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Conference;
use App\Models\ConferenceConfiguration;
use App\Models\ConferenceGallery;
use App\Models\Contribution;
use App\Models\ContributionComment;
use App\Models\FrontMenu;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        else if(isset($request->action) && strcmp($request->action, "conference_stat_change") == 0 ){
            Log::info("Ajax call - conference status change to -> ".$request->conf_stat);

            $cid = $request->conf_id;
            $cstat = $request->conf_stat;

            $conference = Conference::where('status', '!=', '3')->where('id' , '!=', $cid)->first();

            if($cstat == 1 and $conference) return response()->json(['status'=>'NOK', 'msg'=>'Only one conference can be opened at once.']);

            $conference = Conference::find($cid);

            if($cstat == 3){
                FrontMenu::disableMenuOfConference($cid);
                Page::disablePagesOfConference($cid);
            }
            else {
                FrontMenu::enableMenuOfConference($cid);
                Page::enablePagesOfConference($cid);
            }

            $conference->status = $cstat;

            $conference->save();

            return response()->json(['status' => 'OK', 'changed_to' => $cstat]);
        }

        else if(isset($request->action) && strcmp($request->action, "delete_conference_image") == 0 ){
            Log::info("Ajax call - delete conference image -> ".$request->image_id);

            $img_id = $request->image_id;

            ConferenceGallery::deleteConferenceImage($img_id);

            return response()->json(['status' => 'OK']);
        }

        else if(isset($request->action) && strcmp($request->action, "save_contribution_comment") == 0 ){
            Log::info("Ajax call - save comment for contribution -> ".$request->contr_id);

            $comment = new ContributionComment();

            $comment->user_id = Auth::id();
            $comment->contribution_id = $request->contr_id;
            $comment->comment = $request->comment;

            $comment->save();

            return response()->json(['status' => 'OK', 'comment_id' => $comment->id]);
        }

    }
}
