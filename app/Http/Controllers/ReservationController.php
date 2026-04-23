<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $now = Carbon::now(); 

        $upcomingBookings = Reservation::with('stadium')
            ->where('user_id', $user->id)
            ->where('start_time', '>=', $now)
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('start_time', 'asc')
            ->get();

        $historyBookings = Reservation::with('stadium')
    ->where('user_id', $user->id)
    ->where(function($query) use ($now) {
        $query->where('start_time', '<', $now)
              ->orWhereIn('status', ['cancelled', 'confirmed']); 
    })
    ->orderBy('start_time', 'desc')
    ->get();

        return view('Reservation.myReservation', compact('upcomingBookings', 'historyBookings'));
    }


public function cancel(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $now = Carbon::now();
    $matchTime = Carbon::parse($reservation->start_time);
    $hoursDifference = $now->diffInHours($matchTime, false); 

    if ($hoursDifference < 24) {
        return back()->with('error', 'Vous ne pouvez pas annuler un match à moins de 24h du coup d\'envoi.');
    }

    $user = \App\Models\User::find(Auth::id());
    
    $user->increment('wallet_balance', $reservation->final_price); 

    $reservation->update(['status' => 'cancelled']);

    return back()->with('success', 'Réservation annulée avec succès ! ' . $reservation->price . ' DH ont été ajoutés à votre Portefeuille.');
}
}