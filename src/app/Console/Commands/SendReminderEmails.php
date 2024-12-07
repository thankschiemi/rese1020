<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReminderMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    // コマンドの説明
    protected $signature = 'reminder:send';
    protected $description = '予約当日の朝にリマインダーを送信します';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // 今日の予約データを取得
        $today = Carbon::now()->format('Y-m-d');
        $reservations = Reservation::whereDate('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            // メール送信
            Mail::to($reservation->email)->send(new ReminderMail($reservation));

            $this->info("リマインダー送信済み: " . $reservation->email);
        }

        $this->info('全リマインダーの送信を完了しました。');
    }
}
