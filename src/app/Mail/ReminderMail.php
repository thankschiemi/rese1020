<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation; // 予約データを保持

    /**
     * コンストラクタで予約データを受け取る
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
        Log::info('ReminderMail initialized with reservation:', [
            'id' => $reservation->id,
            'restaurant_id' => $reservation->restaurant_id,
        ]);
    }

    public function build()
    {
        $this->reservation->load('restaurant');
        Log::info('Reservation with restaurant loaded:', [
            'id' => $this->reservation->id,
            'restaurant_name' => optional($this->reservation->restaurant)->name,
        ]);

        return $this
            ->subject('予約リマインダーのお知らせ')
            ->view('emails.emails_reminder')
            ->with([
                'reservation' => $this->reservation,
            ]);
    }
}
