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
                      ->orWhereIn('status', ['cancelled', 'confiremd','pending']);
            })
            ->orderBy('start_time', 'desc')
            ->get();

        return view('Reservation.myReservation', compact('upcomingBookings', 'historyBookings'));
    }
}