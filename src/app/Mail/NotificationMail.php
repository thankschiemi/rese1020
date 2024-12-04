<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $member;

    public function __construct($subject, $message, $member)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->member = [
            'name' => $member->name,
            'email' => $member->email,
        ];
    }


    public function build()
    {
        // デバッグ用ログ
        Log::info('メールに渡されるmember:', ['member' => $this->member]);

        return $this->subject($this->subject)
            ->view('emails.notification')
            ->with([
                'message' => $this->message,
                'member' => $this->member,
            ]);
    }
}
