<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Contribution;
use App\Models\ContributionComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AjaxExternalController extends Controller
{
    public function main(Request $request)
    {
        if (isset($request->action) && strcmp($request->action, "get_contribution_and_comments") == 0) {
            Log::info("Ajax call - get contribution and comments -> " . $request->contr_id);

            $contr_id = $request->contr_id;
            $contr = Contribution::find($contr_id);
            $comments = ContributionComment::join('user_profiles as up', 'contribution_comments.user_id', "=", "up.user_id")->where('contribution_id', $contr_id)->get();

            return response()->json(['status' => 'OK', 'contribution' => $contr, 'comments' => $comments]);
        }

    }
}
