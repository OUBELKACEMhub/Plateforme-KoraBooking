<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stadium;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();

        $totalStadiums = Stadium::count();

        $totalReservations = Reservation::count();

       
        $totalRevenue = Reservation::where('status', 'confirmed')->sum('final_price');

       
        $recentReservations = Reservation::with(['user', 'stadium'])
                                        ->latest()
                                        ->take(5)
                                        ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalStadiums', 
            'totalReservations', 
            'totalRevenue',
            'recentReservations'
        ));
    }


    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function stadiums()
    {
        $stadiums = Stadium::latest()->paginate(10);
        return view('admin.stadiums', compact('stadiums'));
    }

    public function reservations()
    {
        $reservations = Reservation::with(['user', 'stadium'])->latest()->paginate(10);
        return view('admin.reservations', compact('reservations'));
    }


    public function toggleBan($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas bannir votre propre compte.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        $message = $user->is_banned ? 'Utilisateur banni avec succès.' : 'Le compte de l\'utilisateur a été réactivé.';
        return back()->with('success', $message);
    }
}