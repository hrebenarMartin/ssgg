<?php

namespace App\Http\Controllers\Backend;

use App\Models\EmailMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class EmailSenderController extends Controller
{
    public function cron(){
        Log::info('Cron email check '.now()->format("d,M Y H:i"));
        $em = new EmailMessage();
        $em->sendWaitingEmails();
        return;
    }
}
