<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerNotificationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class EmailController extends Controller
{

    public function create()
    {
        return view('emails.create');
    }

    public function send(OwnerNotificationRequest $request)
    {
        $subject = $request->subject;
        $message = $request->message;
        $recipientEmail = $request->recipient;

        $member = (object) [
            'name' => auth()->check() ? auth()->user()->name : '送信者名（仮）',
            'email' => $recipientEmail,
        ];

        try {
            Mail::to($recipientEmail)->send(new NotificationMail($subject, $message, $member));
            return redirect()->back()->with('success', 'メールが送信されました！');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'メール送信に失敗しました。');
        }
    }
}
