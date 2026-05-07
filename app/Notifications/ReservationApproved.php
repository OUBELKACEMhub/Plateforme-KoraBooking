<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReservationApproved extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'stadium_name' => $this->reservation->stadium->name,
            'message' => 'Bonne nouvelle ! Votre réservation pour le terrain ' . $this->reservation->stadium->name . ' a été approuvée par le manager.',
            'type' => 'success'
        ];
    }
}