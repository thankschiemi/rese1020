<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;

class ReviewController extends Controller
{

    public function create($reservation_id)
    {
        // 予約情報を取得
        $reservation = Reservation::findOrFail($reservation_id);

        // ビューに予約情報を渡して表示
        return view('reviews.create', compact('reservation'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create($validated);

        return redirect()->route('mypage')->with('success', '評価を保存しました！');
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->route('mypage')->with('success', '評価を更新しました！');
    }
}
