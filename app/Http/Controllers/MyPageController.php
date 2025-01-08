<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('account-settings');
        }

        $reservations = Reservation::where('member_id', $user->id)
            ->with(['restaurant', 'restaurant.genre', 'restaurant.region'])
            ->get()
            ->map(function ($reservation) {
                $reservation->qrData = $reservation->generateQrData();
                return $reservation;
            });

        $favorites = Favorite::where('member_id', $user->id)
            ->with(['restaurant.region', 'restaurant.genre'])
            ->get();

        return view('my_page', compact('reservations', 'favorites', 'user'));
    }
}
