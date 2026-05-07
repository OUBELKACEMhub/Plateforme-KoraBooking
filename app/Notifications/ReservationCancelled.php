<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReservationCancelled extends Notification
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
        
        $clientName = $this->reservation->user->name;
        $stadiumName = $this->reservation->stadium->name;
        $date = \Carbon\Carbon::parse($this->reservation->start_time)->format('d/m/Y à H:i');

        return [
            'reservation_id' => $this->reservation->id,
            'stadium_name' => $stadiumName,
            'message' => "Annulation : Le client {$clientName} a annulé sa réservation pour le terrain {$stadiumName} prévue le {$date}.",
            'type' => 'danger' 
        ];
    }
}