<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Application;
use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApplicationsController extends Controller
{
    public function confirmApplication($cid, $aid){
        $conference = Conference::findOrFail($cid);
        if (!Auth::user()->roles()->where('role_id', 1)->first() and $conference->status == 3) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

        $application = Application::findOrFail($aid);

        $application->status = 2;
        $application->save();

        return redirect()->back()->with('message', "Success")->with('message_type', "success");
    }

    public function confirmApplicationPayment($cid, $aid){
        $conference = Conference::findOrFail($cid);
        if (!Auth::user()->roles()->where('role_id', 1)->first() and $conference->status == 3) {
            return redirect()->back()->with('message', "Access denied")->with('message_type', "danger");
        }

        $application = Application::findOrFail($aid);

        $application->status = 3;
        $application->save();

        return redirect()->back()->with('message', "Success")->with('message_type', "success");
    }

    public function show($cid, $aid){
        $appl = Application::findOrFail($aid);

        if(!$appl){
            abort(404);
        }

        $conference = Conference::findOrFail($cid);

        return view('backend.application.detail')
            ->with('appl', $appl)
            ->with('conference', $conference)
            ->with('config', $conference->config);
    }
}
