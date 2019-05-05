<?php

namespace App\Http\Controllers\Backend;

use App\Models\EmailMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailSenderController extends Controller
{
    public function cron(){
        $em = new EmailMessage();

        $em->sendWaitingEmails();

        return;
    }
}
