<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use Illuminate\Support\Facades\Session;


class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::all();
        $genres = Genre::all();

        $query = Restaurant::query();

        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }
        if ($request->filled('keyword')) {
            $query->where('name', 'LIKE', "%{$request->keyword}%");
        }

        $restaurants = $query->orderBy('id')->get();

        return view('restaurant_all', compact('restaurants', 'regions', 'genres'));
    }



    public function detail($shop_id)
    {
        $restaurant = Restaurant::with(['region', 'genre'])->findOrFail($shop_id);
        $reservation = Reservation::where('restaurant_id', $shop_id)->first();

        return view('restaurant_detail', compact('restaurant', 'reservation'));
    }

    public function store(StoreReservationRequest $request)
    {
        // 'action'の値を確認
        if ($request->input('action') === 'preview') {
            Session::put('reservation_preview', [
                'restaurant_name' => Restaurant::find($request->restaurant_id)->name,
                'date' => $request->date,
                'time' => $request->time,
                'number' => $request->number,
            ]);

            // プレビューのリダイレクト
            return redirect()->back()->withInput()->with('preview', true);
        }

        if ($request->input('action') === 'reserve') {
            try {
                // 予約情報をデータベースに保存
                Reservation::create([
                    'member_id' => $request->member_id,
                    'restaurant_id' => $request->restaurant_id,
                    'reservation_date' => $request->date,
                    'reservation_time' => $request->time,
                    'number_of_people' => $request->number,
                ]);

                // プレビュー情報をクリア
                Session::forget('reservation_preview');

                // 予約完了画面にリダイレクト
                return redirect()->route('reserve.done')->with('success', '予約が完了しました！');
            } catch (\Exception $e) {
                // エラー時は入力内容を保持してリダイレクト
                return redirect()->back()->withInput()->with('error', '予約に失敗しました。もう一度お試しください。');
            }
        }

        // 不正な操作の場合
        return redirect()->back()->withInput()->with('error', '不正な操作が行われました。');
    }

    public function done()
    {
        Session::reflash();
        // 完了ページの表示
        return view('reservation_done');
    }
}
