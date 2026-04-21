<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Reservation;
use App\Models\Offer;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function index()
    {
        $managerId = Auth::id();

        $stadiums = Stadium::where('manager_id', $managerId)->get();
        
        $stadiumIds = $stadiums->pluck('id');

        $totalRevenue = Reservation::whereIn('stadium_id', $stadiumIds)
                                   ->where('status', 'confirmed') 
                                   ->sum('final_price');
                                   

        $monthlyBookingsCount = Reservation::whereIn('stadium_id', $stadiumIds)
                                           ->whereMonth('created_at', Carbon::now()->month)
                                           ->whereYear('created_at', Carbon::now()->year)
                                           ->count();

        $activeOffersCount = Offer::whereHas('stadiums', function($query) use ($managerId) {
                                        $query->where('manager_id', $managerId);
                                    })
                                    ->whereDate('start_date', '<=', now())
                                    ->whereDate('end_date', '>=', now())
                                    ->count();

        $pendingReservations = Reservation::with('user')
                                          ->whereIn('stadium_id', $stadiumIds)
                                          ->where('status', 'pending')
                                          ->orderBy('created_at', 'desc')
                                          ->get();

        $upcomingBookings = Reservation::with(['user', 'stadium'])
                                       ->whereIn('stadium_id', $stadiumIds)
                                       ->whereIn('status', ['confirmed'])
                                      ->where('start_time', '>=', now())
                                       ->orderBy('start_time', 'asc')
                                       ->take(10) 
                                       ->get();
                                       

        return view('manager.dashboard', compact(
            'stadiums',
            'totalRevenue',
            'monthlyBookingsCount',
            'activeOffersCount',
            'pendingReservations',
            'upcomingBookings'
        ));
    }


    public function updateReservationStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:confirmed,canceled',
    ]);

    $reservation = Reservation::findOrFail($id);

    $reservation->status = $request->status;
    $reservation->save();

        if ($reservation->status === 'confirmed') {
        return redirect()->route('manager.dashboard')->with('success', 'La réservation a été acceptée avec succès !');
    } else {
    return redirect()->route('manager.dashboard')->with('error', 'La réservation a été refusée.');
    }
}

public function afficherMesTerians(){
    $managerId = Auth::id();
    $stadiums = Stadium::where('manager_id', $managerId)->get();
    
    return view('manager.stadiums', compact('stadiums'));
}

public function getManagerReviews()
{
    $managerId = Auth::id();

    $reviews = Review::with(['user', 'stadium']) 
        ->whereHas('stadium', function ($query) use ($managerId) {
            $query->where('manager_id', $managerId);
        })
        ->orderBy('created_at', 'desc') 
        ->paginate(10); 

    return view('manager.reviews', compact('reviews'));
}

public function getManagerOffers()
{
    $managerId = Auth::id();

    $offers = Offer::with(['creator', 'stadiums'])
        ->where('creator_id', $managerId) 
        ->latest()                   
        ->paginate(10);              

    return view('manager.offers', compact('offers'));
}

}