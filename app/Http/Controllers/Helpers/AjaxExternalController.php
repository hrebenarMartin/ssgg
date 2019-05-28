<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Contribution;
use App\Models\ContributionComment;
use Carbon\Carbon;
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
            $contr = Contribution::findOrFail($contr_id);
            $comments = ContributionComment::getContributionComments($contr_id);
            foreach ($comments as $comment) {
                $comment->date = Carbon::createFromFormat(
                    "Y-m-d H:i:s",
                    $comment->created_at)->format("d,M Y H:i:s");
            }
            return response()->json([
                'status' => 'OK',
                'contribution' => $contr,
                'comments' => $comments
                ]);
        }

    }
}
