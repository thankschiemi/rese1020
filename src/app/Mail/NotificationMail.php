<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $emailMessage;
    public $member;

    public function __construct($subject, $message, $member)
    {
        $this->subject = $subject;
        $this->emailMessage = is_string($message) ? $message : json_encode($message, JSON_UNESCAPED_UNICODE);
        $this->member = [
            'name' => $member->name,
            'email' => $member->email,
        ];
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.notification')
            ->with([
                'emailMessage' => $this->emailMessage,
                'member' => $this->member,
            ]);
    }
}
