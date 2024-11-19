<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class EmailController extends Controller
{
    // メール作成フォームの表示
    public function create()
    {
        return view('emails.create');
    }

    // メール送信処理
    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'recipient' => 'required|email',
        ]);

        // メール送信
        $messageContent = [
            'title' => $request->input('subject'),
            'message' => $request->input('body'),
        ];

        Mail::to($request->input('recipient'))->send(new NotificationMail($messageContent));

        return redirect()->back()->with('success', 'メールが送信されました！');
    }
}
