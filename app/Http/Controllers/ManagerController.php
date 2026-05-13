<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Reservation;
use App\Models\Offer;
use App\Models\Review;
use App\Notifications\ReservationApproved;
use App\Notifications\ReservationCancelled;
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
        'status' => 'required|in:confirmed,cancelled',
    ]);

    $reservation = Reservation::findOrFail($id);

    $reservation->status = $request->status;
    $reservation->save();

        if ($reservation->status === 'confirmed') {
        $reservation->user->notify(new ReservationApproved($reservation));
        return redirect()->route('manager.dashboard')->with('success', 'La réservation a été acceptée avec succès !');
    } else {
         $reservation->user->notify(new ReservationCancelled($reservation));
    return redirect()->route('manager.dashboard')->with('error', 'La réservation a été refusée.');
    }
}

public function afficherMesTerians(){
    $managerId = Auth::id();
    $stadiums = Stadium::where('manager_id', $managerId)->get();
    
    return view('manager.stadiums', compact('stadiums'));
}

public function storeStadium(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'status' => 'required|in:available,maintenance', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stadiums', 'public');
        }

        Stadium::create([
            'name' => $request->name,
            'price' => $request->price,
            'city' => $request->city,
            'address' => $request->address,
            'image' => $imagePath ? '/storage/' . $imagePath : null,
            'status' => $request->status, 
            'manager_id' => Auth::id(),
        ]);

        return back()->with('success', 'Terrain ajouté avec succès.');
    }

 
    public function updateStadium(Request $request, $id)
    {
        $stadium = Stadium::where('manager_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'status' => 'required|in:available,maintenance', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $dataToUpdate = [
            'name' => $request->name,
            'price' => $request->price,
            'city' => $request->city,
            'address' => $request->address,
            'status' => $request->status, 
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stadiums', 'public');
            $dataToUpdate['image'] = '/storage/' . $imagePath;
        }

        $stadium->update($dataToUpdate);

        return back()->with('success', 'Terrain modifié avec succès.');
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

    $stadiums = Stadium::where('manager_id', Auth::id())->get();  

    return view('manager.offers', compact('offers', 'stadiums'));
     
}


    public function updateOffer(Request $request, $id)
    {
        $offer = Offer::where('creator_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:promo,flash,seasonal',
            'discount_percentage' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'stadium_id' => 'required' 
        ]);

        $offer->update([
            'title' => $request->title,
            'type' => $request->type,
            'discount_percentage' => $request->discount_percentage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

      

        return redirect()->route('manager.offers')->with('success', 'Offre modifiée avec succès.');
    }

 
    public function destroyOffer($id)
    {
        $offer = Offer::where('creator_id', Auth::id())->findOrFail($id);
        $offer->delete();

        return back()->with('success', 'Offre supprimée avec succès.');
    }
}