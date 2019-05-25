<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Message;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailMessage extends Model
{
    const EMAIL_SENT = 1;

    protected $table = "email_messages";
    protected $fillable = [
        "recipients",
        "subject",
        "status",
        "module",
        "data",
        "send_time",
    ];
    private $content;

    public static function allMessagesByDate()
    {
        return EmailMessage::orderByDesc("send_time")->get();
    }

    public static function addMailToQueue($recipients, $sub, $module, $data = [])
    {
        $em = new self();

        $em->recipients = json_encode($recipients);
        $em->subject = $sub;
        $em->status = 0;
        $em->module = $module;
        $em->data = json_encode($data);

        $em->save();
    }

    public function sendWaitingEmails()
    {
        try {
            $emails = $this->getUnsetMails();

            foreach ($emails as $mail) {
                if (strcmp($mail->module, "Test") == 0) {
                    $this->sendMail($mail, 'test');
                } else if (strcmp($mail->module, "Review-assign") == 0) {
                    $this->sendMail($mail, 'review-assign');
                } else if (strcmp($mail->module, "Review-accepted") == 0) {
                    $this->sendMail($mail, 'review_accepted');
                } else if (strcmp($mail->module, "Review-rejected") == 0) {
                    $this->sendMail($mail, 'review_rejected');
                } else if (strcmp($mail->module, "Review-updated") == 0) {
                    $this->sendMail($mail, 'review_updated');
                }
            }

        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    private function getUnsetMails()
    {
        return EmailMessage::where('send_time', "<=", now()->addHours(3)->format("Y-m-d G:i:s"))
            ->where('status', 0)
            ->limit(20)
            ->get();
    }

    private function sendMail($em, $template)
    {
        try {
            $emails = json_decode($em->recipients);
            if (!is_array($emails)) $emails = [$emails];

            $data_raw = json_decode($em->data);

            $this->content = null;
            if (array_key_exists('Data', $data_raw)) {
                $this->content['testData'] = $data_raw->Data;
            }
            if (array_key_exists('contribution_author', $data_raw)) {
                $this->content['contribution_author'] = Profile::find($data_raw->contribution_author);
            }
            if (array_key_exists('reviewer', $data_raw)) {
                $this->content['reviewer'] = User::find($data_raw->reviewer)->profile;
            }
            if (array_key_exists('review_assigned_by', $data_raw)) {
                $this->content['review_assigned_by'] = User::find($data_raw->review_assigned_by)->profile;
            }

            $this->send_to = array_unique($emails);
            $this->subject = $em->subject;
            try {
                Mail::send(["html" => "email.html." . $template, "text" => "email.text." . $template], ["content" => $this->content],
                    function (Message $message) {

                        $message
                            ->to($this->send_to)
                            ->subject($this->subject);

                    });
                $em->status = self::EMAIL_SENT;
                $em->updated_at = Carbon::now();
                $em->save();
            } catch (\Exception $e) {
                Log::critical($e->getMessage());
            }
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
        }
    }

}
