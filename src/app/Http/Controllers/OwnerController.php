<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\OwnerStoreRequest;
use App\Http\Requests\OwnerUpdateStoreRequest;
use App\Http\Requests\OwnerNotificationRequest;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'ログインしてください。');
        }

        $stores = $user->restaurants;

        return view('owner.owner_home', compact('stores', 'user'));
    }

    public function createStore()
    {
        $regions = Region::all();
        $genres = Genre::all();
        return view('owner.create_store', compact('regions', 'genres'));
    }

    public function storeStore(OwnerStoreRequest $request)
    {
        $store = new Restaurant();
        $store->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $store->image_url = $imagePath;
        }

        $store->member_id = Auth::id();
        $store->save();

        return redirect()->route('owner.store_list')->with('success', '店舗情報を作成しました！');
    }

    public function updateStore(OwnerUpdateStoreRequest $request, $id)
    {
        $store = Restaurant::findOrFail($id);
        $store->update($request->all());

        return redirect()->route('owner.store_list')->with('success', '店舗情報を更新しました！');
    }

    public function editStore($id)
    {
        $store = Restaurant::findOrFail($id);
        $regions = Region::all();
        $genres = Genre::all();

        return view('owner.edit_store', compact('store', 'regions', 'genres'));
    }

    public function listStores()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'ログインしてください。');
        }

        $stores = $user->restaurants->sortByDesc('updated_at');

        return view('owner.store_list', compact('stores', 'user'));
    }

    public function manageReservations(Request $request)
    {
        $user = Auth::user();

        $stores = $user->restaurants;

        $reservations = collect();
        foreach ($stores as $store) {
            $storeReservations = $store->reservations()
                ->with(['restaurant', 'member'])
                ->get();
            $reservations = $reservations->concat($storeReservations);
        }

        $sortedReservations = $reservations->sortBy([
            fn($a, $b) => strcmp($a['reservation_date'], $b['reservation_date']),
            fn($a, $b) => strcmp($a['reservation_time'], $b['reservation_time']),
        ]);

        return view('owner.manage_reservations', ['reservations' => $sortedReservations]);
    }

    public function showCampaignForm()
    {
        return view('owner.campaign');
    }

    public function sendNotification(OwnerNotificationRequest $request)
    {
        $user = Auth::user();

        if (!$user || $user->restaurants->isEmpty()) {
            return redirect()->back()->with('error', '店舗情報が見つかりません。');
        }

        $members = \App\Models\Member::whereHas('reservations', function ($query) use ($user) {
            $query->whereIn('restaurant_id', $user->restaurants->pluck('id'));
        })->distinct('email')->get();

        if ($members->isEmpty()) {
            return redirect()->back()->with('success-error', '送信対象の顧客が見つかりませんでした。');
        }

        try {
            foreach ($members as $member) {
                Mail::to($member->email)
                    ->send(new NotificationMail($request->subject, $request->message, $member));
            }
            return redirect()->route('owner.campaign')->with('success', 'お知らせメールを送信しました！');
        } catch (\Exception $e) {
            return redirect()->route('owner.campaign')->with('error', 'メール送信に失敗しました: ' . $e->getMessage());
        }
    }
}
