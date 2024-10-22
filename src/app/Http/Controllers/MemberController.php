<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function accountSettings()
    {
        return view('account_settings');
    }

    public function mainmenu()
    {
        return view('main_menu');
    }
    public function thanks()
    {
        return view('thanks');
    }
}
