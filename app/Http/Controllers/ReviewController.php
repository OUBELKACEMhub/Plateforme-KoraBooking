<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
   public function store(Request $request)
    {
        $validatedData = $request->validate([
            'stadium_id' => 'required|exists:stadiums,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id'    => Auth::id(),
            'stadium_id' => $validatedData['stadium_id'],
            'rating'     => $validatedData['rating'],
            'comment'    => $validatedData['comment'],
        ]);

        $stadium = \App\Models\Stadium::find($validatedData['stadium_id']);
        
        $newAverage = $stadium->reviews()->avg('rating');
        
        $stadium->update([
            'rate' => round($newAverage, 1)
        ]);

        return back()->with('success', 'Votre avis a été publié avec succès !');
    }
}
