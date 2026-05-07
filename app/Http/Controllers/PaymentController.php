<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
  public function show(Request $request, $id)
    {
        $stadium = Stadium::findOrFail($id);
        
        $selectedTime = $request->query('time', '18:00');
        $serviceFee = 3.00;
        
        $total = $stadium->discounted_price + $serviceFee;

        return view('stadiums.show', [
            'stadium' => $stadium,
            'total' => $total,
            'selectedTime' => $selectedTime,
            'date' => date('Y-m-d')
        ]);
    }


public function process(Request $request)
{
    $request->validate([
        'stadium_id'       => 'required|exists:stadiums,id',
        'reservation_date' => 'required|date',
        'reservation_time' => 'required',
        'payment_method'   => 'required|in:card,wallet',
        'cardholder_name'  => 'required_if:payment_method,card|nullable|string|min:3',
    ]);

    $stadium = Stadium::findOrFail($request->stadium_id);
    $serviceFee = 3.00;
    
    $basePrice = $stadium->has_active_offer ? $stadium->discounted_price : $stadium->price;
    $finalPrice = $basePrice + $serviceFee;

    $startTime = Carbon::parse($request->reservation_date . ' ' . $request->reservation_time);
    $endTime = $startTime->copy()->addHour(); 

    // 2. Vérification de la disponibilité
    $isBooked = Reservation::where('stadium_id', $request->stadium_id)
        ->where('start_time', $startTime)
        ->where('status', '!=', 'cancelled') 
        ->exists();

    if ($isBooked) {
        return redirect()->back()->with('error', 'Désolé, le créneau de ' . $request->reservation_time . ' est déjà réservé par quelqu\'un d\'autre.');
    }

    $user = Auth::user();

    if ($request->payment_method === 'wallet') {
        if ($user->wallet_balance < $finalPrice) {
            return redirect()->back()->with('error', 'Solde insuffisant dans votre portefeuille. Veuillez recharger ou utiliser une carte bancaire.');
        }
        
        $user->wallet_balance -= $finalPrice;
        $user->save();
        
    } elseif ($request->payment_method === 'card') {
        
       $user->wallet_balance += 10;
        $user->save();
    }

    Reservation::create([
        'user_id'     => $user->id,
        'stadium_id'  => $request->stadium_id,
        'start_time'  => $startTime,
        'end_time'    => $endTime,
        'final_price' => $finalPrice,
        'status'      => 'pending', 
    ]);

    return redirect()->route('dashboard')
            ->with('success', 'Terrain réservé avec succès ! Vous avez gagné 10 points sur votre Wallet.');
}
}