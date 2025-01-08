<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Notifications\AccountCreated;
use App\Http\Requests\AdminCreateMemberRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_home');
    }

    public function manageStores()
    {

        return view('admin.stores');
    }

    public function notifications()
    {

        return view('admin.notifications');
    }

    public function store(AdminCreateMemberRequest $request)
    {
        try {
            $validated = $request->validated();


            $user = Member::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role' => 'owner',
            ]);


            $user->notify(new AccountCreated($request->password));


            return redirect()->route('admin.users')->with('success_create', '店舗代表者を作成しました。登録したメールアドレス宛に通知を送信しましたので、ご確認ください。');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'ユーザー作成中にエラーが発生しました。']);
        }
    }



    public function manageUsers()
    {
        $users = Member::all();
        return view('admin.users', compact('users'));
    }


    public function updateRole(Request $request, $id)
    {

        $role = $request->input('role');


        if (!in_array($role, ['user', 'owner', 'admin'], true)) {
            return redirect()->route('admin.users')->withErrors(['role' => '無効な権限が指定されました。']);
        }

        $user = Member::findOrFail($id);

        $oldRole = $user->role;
        $user->role = $request->role;
        $user->save();

        $adminName = auth()->user()->name;
        $message = "{$adminName} がユーザー {$user->name} の権限を「{$oldRole}」から「{$role}」に更新しました。";

        return redirect()->route('admin.users')->with('success_update', $message);
    }
}
