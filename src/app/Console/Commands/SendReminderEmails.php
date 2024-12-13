<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use App\Models\Reservation;

class SendReminderEmails extends Command

{
    protected $signature = 'reminder:send-emails';
    protected $description = '予約当日のリマインダーメールを送信する';

    public function handle()
    {
        // 当日の予約を取得
        $reservations = Reservation::with(['restaurant', 'member'])
            ->whereDate('reservation_date', now()->toDateString())
            ->get();

        foreach ($reservations as $reservation) {
            try {
                Mail::to($reservation->member->email)
                    ->send(new ReminderMail($reservation));

                $this->info("リマインダー送信成功: {$reservation->member->email}");
            } catch (\Exception $e) {
                $this->error("リマインダー送信失敗: {$reservation->member->email}");
            }
        }

        $this->info('全リマインダーの送信を完了しました。');
    }
}
