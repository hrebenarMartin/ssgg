<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Message;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailMessage extends Model
{
    const EMAIL_SENT = 1;

    protected $table = "email_messages";

    private $send_to;
    private $subject;

    protected $fillable = [
        "recipients",
        "subject",
        "status",
        "module",
        "data",
        "send_time",
    ];


    public static function allMessagesByDate(){
        return EmailMessage::orderByDesc("send_time")->get();
    }

    private function getUnsetMails(){
        return EmailMessage::where('send_time', "<=", now())
            ->where('status', 0)
            ->limit(20)
            ->get();
    }

    public function sendWaitingEmails(){
        try{
            $emails = $this->getUnsetMails();

            foreach ($emails as $mail){
                if(strcmp($mail->module, "Test") == 0){
                    $this->sendTestMail($mail);
                }
            }

        }catch (\Exception $e){
            Log::error($e);
        }
    }

    private function sendTestMail($em){

        $template = "test";

        $content = "Hey";
        $emails = json_decode($em->recipients);
        if (!is_array($emails)) $emails = [$emails];

        $this->send_to = array_unique($emails);

        $this->subject = $em->subject;

        Mail::send(["html" => "email.html.".$template, "text" => "email.text.".$template], ["content" => $content],
            function (Message $message){

                $message
                    ->to($this->send_to)
                    ->subject($this->subject);

            });

        $em->status = self::EMAIL_SENT;
        $em->updated_at = Carbon::now();

        $em->save();
    }

}
