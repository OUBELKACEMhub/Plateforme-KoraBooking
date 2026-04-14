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

    
}