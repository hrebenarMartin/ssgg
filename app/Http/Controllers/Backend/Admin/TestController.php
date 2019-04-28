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


        //dd(Auth::user()->roles()->where('role_id', 1)->first());

//        $r[] = "hrebenar.martin1@gmail.com";
//        $r[] = "m.hrebenar365@gmail.com";
//        $s = "Test subject";
//        $m = "Test";
//        $d = ["Data"=>"test data"];
//
//        //EmailMessage::addTestMail();
//        EmailMessage::addMailToQueue($r, $s, $m, $d);

        $em = new EmailMessage();

        $em->sendWaitingEmails();

        return view('backend.test');
    }
}
