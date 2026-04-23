<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OfferController extends Controller
{

public function storeAndAttachOffer(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'discount_percentage' => 'required|numeric|min:1|max:100',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'stadium_id' => 'required|exists:stadiums,id', 
        'type' => 'required|in:flash,seasonal,promo',
    ]);

    $stadium = Stadium::findOrFail($request->stadium_id);

    if ($stadium->manager_id !== Auth::id()) {
        abort(403, 'Action non autorisée. Ce n\'est pas votre terrain.');
    }

    $offer = Offer::create([
        'title' => $request->title,
        'discount_percentage' => $request->discount_percentage,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'type' => $request->type,
        'creator_id' => Auth::id(),
    ]);

    $stadium->offers()->attach($offer->id);

    return back()->with('success', 'La promotion a été créée et appliquée au terrain avec succès !');
}

    public function removeOfferFromStadium(Request $request, $stadiumId, $offerId)
{
    $stadium = Stadium::findOrFail($stadiumId);

    if ($stadium->manager_id !== Auth::id()) {
        abort(403, 'Action non autorisée. Ce n\'est pas votre terrain.');
    }

    $stadium->offers()->detach($offerId);

    return back()->with('success', 'L\'offre a été retirée du terrain avec succès !');
}
}
