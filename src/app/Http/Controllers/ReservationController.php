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
        // ログイン済みユーザーのみアクセス可能なメソッドを指定
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function store(StoreReservationRequest $request)
    {
        $user_id = Auth::id(); // ログイン中のユーザーIDを取得

        // 予約情報をデータベースに保存
        $reservation = Reservation::create([
            'member_id' => $user_id,
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->date,
            'reservation_time' => $request->time,
            'number_of_people' => $request->number,
        ]);

        // 予約完了画面にリダイレクト
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

            // 予約キャンセル後にリダイレクト
            return redirect()->route('mypage')->with('success', sprintf(
                '「%s」の予約（%s %s）が正常にキャンセルされました。',
                $reservationDetails['restaurant_name'],
                $reservationDetails['reservation_date'],
                date('H:i', strtotime($reservationDetails['reservation_time']))
            ));
        }

        // キャンセル対象が見つからない場合
        return redirect()->route('mypage')->with('error', 'キャンセルする予約が見つかりませんでした。');
    }






    public function done()
    {
        // リダイレクトされたときのデータを受け取る
        $restaurant_id = session('restaurant_id');

        // リダイレクト後に戻るためのリンクを設定
        return view('reservation_done', compact('restaurant_id'));
    }

    public function edit($id)
    {
        // 指定された予約情報を取得
        $reservation = Reservation::findOrFail($id);

        // 編集画面を表示
        return view('reservations.edit', compact('reservation'));
    }


    public function update(UpdateReservationRequest $request, $id)
    {
        // バリデーション済みデータの取得
        $validated = $request->validated();

        // 予約情報取得
        $reservation = Reservation::findOrFail($id);

        // 更新
        $reservation->fill($validated)->save();

        // リダイレクト
        return redirect()->route('mypage')->with('success', '予約情報が変更されました。');
    }
}
