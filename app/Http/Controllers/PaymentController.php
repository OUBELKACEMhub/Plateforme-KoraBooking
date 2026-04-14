<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    // Affiche la page de paiement
    public function show(Request $request, $id)
    {
        $stadium = Stadium::findOrFail($id);
        
        // Récupère l'heure de l'URL ou met 18:00 par défaut
        $selectedTime = $request->query('time', '18:00');
        
        $serviceFee = 3.00;
        $total = $stadium->price + $serviceFee;

        return view('stadiums.show', [
            'pitch' => $stadium,
            'total' => $total,
            'selectedTime' => $selectedTime,
            'date' => date('Y-m-d') // Format pour la BDD
        ]);
    }

    // Traite le paiement et enregistre en BDD
    public function process(Request $request)
    {
        $request->validate([
            'stadium_id' => 'required|exists:stadiums,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'total_amount' => 'required|numeric',
            'cardholder_name' => 'required|string|min:3',
        ]);

        // 2. Calcul des horaires pour ta table reservations
        $startTime = Carbon::parse($request->reservation_date . ' ' . $request->reservation_time);
        $endTime = $startTime->copy()->addHour(); // Match de 1h

        // 3. Création de l'enregistrement
        Reservation::create([
            'user_id'     => Auth::id(),
            'stadium_id'  => $request->stadium_id,
            'start_time'  => $startTime,
            'end_time'    => $endTime,
            'final_price' => $request->total_amount,
            'status'      => 'pending',
        ]);

        // 4. Redirection vers le dashboard avec message
        return redirect()->route('reservation')
            ->with('success', 'Terrain réservé avec succès pour ' . $request->reservation_time . ' !');
    }
}