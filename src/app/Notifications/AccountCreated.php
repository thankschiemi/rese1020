<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreated extends Notification
{
    use Queueable;

    public $password; // 初期パスワードを保持

    /**
     * コンストラクタで初期パスワードを受け取る
     *
     * @param string $password
     */
    public function __construct($password)
    {
        $this->password = $password; // 初期パスワードをセット
    }

    /**
     * 通知の送信チャネル
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * メール通知の内容
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
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

    /**
     * 通知の配列表現
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
