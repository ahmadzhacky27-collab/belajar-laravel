<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['email','required'],
            'password' => ['required']
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard.index'))->with('success','Selamat datang kembali di Dashboard Admin PPKD Sticker');
        }

        return back()->withErrors(['email'=> 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // 1 method get
        // 2 method post
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        redirect()->to('admin/login');
    }
}
