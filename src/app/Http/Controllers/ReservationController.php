<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function store(StoreReservationRequest $request)
    {
        $user_id = Auth::id();

        $reservation = Reservation::create([
            'member_id' => $user_id,
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->date,
            'reservation_time' => $request->time,
            'number_of_people' => $request->number,
        ]);

        return redirect()->route('reserve.done')->with('restaurant_id', $request->restaurant_id);
    }

    public function destroy($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        if ($reservation) {
            $reservationDetails = [
                'restaurant_name' => $reservation->restaurant->name,
                'reservation_date' => $reservation->reservation_date,
                'reservation_time' => $reservation->reservation_time,
            ];

            $reservation->delete();

            return redirect()->route('mypage')->with('success', sprintf(
                '「%s」の予約（%s %s）が正常にキャンセルされました。',
                $reservationDetails['restaurant_name'],
                $reservationDetails['reservation_date'],
                date('H:i', strtotime($reservationDetails['reservation_time']))
            ));
        }

        return redirect()->route('mypage')->with('error', 'キャンセルする予約が見つかりませんでした。');
    }

    public function done()
    {
        $restaurant_id = session('restaurant_id');
        return view('reservation_done', compact('restaurant_id'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    public function update(UpdateReservationRequest $request, $id)
    {
        $validated = $request->validated();
        $reservation = Reservation::findOrFail($id);
        $reservation->fill($validated)->save();

        return redirect()->route('mypage')->with('success', '予約情報が変更されました。');
    }
}
