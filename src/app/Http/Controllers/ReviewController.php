<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        $reviews = Review::where('restaurant_id', $reservation->restaurant_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('reviews.create', compact('reservation', 'reviews'));
    }

    public function store(CreateReviewRequest $request)
    {
        $validated = $request->validated();

        $validated['member_id'] = Auth::id();

        Review::create($validated);

        return redirect()->route('mypage')->with('success', '評価を送信しました！下記の評価ボタンをクリックすると、作成した評価を確認できます。');
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }
}
