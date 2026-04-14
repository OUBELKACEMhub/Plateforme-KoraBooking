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
    $total = $stadium->price + $serviceFee;

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
            'stadium_id' => 'required|exists:stadiums,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'total_amount' => 'required|numeric',
            'cardholder_name' => 'required|string|min:3',
        ]);

        
        $startTime = Carbon::parse($request->reservation_date . ' ' . $request->reservation_time);
        $endTime = $startTime->copy()->addHour(); 

        // --- DISPONIBILITÉ 
        $isBooked = Reservation::where('stadium_id', $request->stadium_id)
            ->where('start_time', $startTime)
            ->where('status', '!=', 'cancelled') 
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'Désolé, le créneau de ' . $request->reservation_time . ' est déjà réservé par quelqu\'un d\'autre.');
        }
        // -------------------------------------------------------

        Reservation::create([
            'user_id'     => Auth::id(),
            'stadium_id'  => $request->stadium_id,
            'start_time'  => $startTime,
            'end_time'    => $endTime,
            'final_price' => $request->total_amount,
            'status'      => 'pending',
        ]);

        // 4. Redirection avec succès
        return redirect()->back()->with('success', 'Terrain réservé avec succès pour ' . $request->reservation_time . ' !');
    }
}