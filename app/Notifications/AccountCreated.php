<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreated extends Notification
{
    use Queueable;

    public $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('アカウント作成のお知らせ')
            ->greeting("こんにちは、{$notifiable->name}様")
            ->line('店舗代表者としてアカウントが作成されました。以下の情報でログインしてください。')
            ->line("メールアドレス: {$notifiable->email}")
            ->line("初期パスワード: {$this->password}")
            ->action('ログイン', url('/login'))
            ->line('ログイン後、パスワードを変更することをおすすめします。')
            ->line('ご利用いただきありがとうございます！');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
