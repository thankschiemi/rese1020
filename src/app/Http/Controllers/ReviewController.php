<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($reservation_id)
    {
        // 予約情報を取得
        $reservation = Reservation::findOrFail($reservation_id);

        // 該当店舗の評価一覧を取得 (ページネーションを追加)
        $reviews = Review::where('restaurant_id', $reservation->restaurant_id)
            ->orderBy('created_at', 'desc') // 評価を新しい順に
            ->paginate(5); // 1ページに5件表示

        // ビューに予約情報と評価一覧を渡して表示
        return view('reviews.create', compact('reservation', 'reviews'));
    }

    public function store(Request $request)
    {
        try {
            // バリデーション
            $validated = $request->validate([
                'reservation_id' => 'required|exists:reservations,id',
                'restaurant_id' => 'required|exists:restaurants,id',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        // member_idを追加
        $validated['member_id'] = Auth::id();

        // データを保存
        Review::create($validated);

        return redirect()->route('mypage')->with('success', '評価を送信しました！マイページの評価ボタンをクリックすると、作成した評価を確認できます。');
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
