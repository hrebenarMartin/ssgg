<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\EmailMessage;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function index(){


        dd(Auth::user()->roles()->where('role_id', 1)->first());

//        $em = new EmailMessage();
//
//        $em->sendWaitingEmails();

        return view('backend.test');
    }
}
