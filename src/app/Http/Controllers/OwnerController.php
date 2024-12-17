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
use Illuminate\Support\Facades\Log;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // ログイン中のユーザーを取得

        if (!$user) {
            abort(403, 'ログインしてください。');
        }

        // ログイン中のユーザーに関連する店舗を取得
        $stores = $user->restaurants;

        // ビューにデータを渡す
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
        $store = Restaurant::findOrFail($id); // ID で店舗情報を取得
        $regions = Region::all();
        $genres = Genre::all();

        return view('owner.edit_store', compact('store', 'regions', 'genres'));
    }



    public function listStores()
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        if (!$user) {
            abort(403, 'ログインしてください。');
        }

        // ログイン中のユーザーに関連する店舗を取得
        $stores = $user->restaurants; // `restaurants` はリレーション名

        // ログイン中のユーザーに関連する店舗を取得し、更新日順にソート
        $stores = $user->restaurants->sortByDesc('updated_at'); // updated_at の降順

        return view('owner.store_list', compact('stores', 'user'));
    }
    public function manageReservations(Request $request)
    {
        $user = Auth::user();

        // ログイン中のユーザーが所有する店舗を取得
        $stores = $user->restaurants;

        // 全ての店舗の予約を取得
        $reservations = collect(); // コレクションを初期化
        foreach ($stores as $store) {
            $storeReservations = $store->reservations()
                ->with(['restaurant', 'member']) // リレーションをロード
                ->get(); // 個々の予約データを取得
            $reservations = $reservations->concat($storeReservations); // コレクションを結合
        }

        // 全体の並び替え
        $sortedReservations = $reservations->sortBy([
            fn($a, $b) => strcmp($a['reservation_date'], $b['reservation_date']), // 日付順
            fn($a, $b) => strcmp($a['reservation_time'], $b['reservation_time']), // 時間順
        ]);

        return view('owner.manage_reservations', ['reservations' => $sortedReservations]);
    }
    public function showCampaignForm()
    {
        // キャンペーンフォームを表示する
        return view('owner.campaign');
    }

    public function sendNotification(OwnerNotificationRequest $request)
    {
        // ログイン中のユーザー（店舗代表者）を取得
        $user = Auth::user();

        // 店舗代表者に関連する店舗がない場合の処理
        if (!$user || $user->restaurants->isEmpty()) {
            return redirect()->back()->with('error', '店舗情報が見つかりません。');
        }

        // 店舗代表者が管理する店舗を利用した顧客を取得
        $members = \App\Models\Member::whereHas('reservations', function ($query) use ($user) {
            $query->whereIn('restaurant_id', $user->restaurants->pluck('id'));
        })->distinct('email')->get();

        if ($members->isEmpty()) {
            return redirect()->back()->with('error', '送信対象の顧客が見つかりませんでした。');
        }

        // メール送信処理
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
