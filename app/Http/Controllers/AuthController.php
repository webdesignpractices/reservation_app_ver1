<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Appointment;

class AuthController extends Controller
{
    public function index(){
        return view('user.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],    
            ]);

            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->route('menu.services.index');
            }
            return back()
            ->withErrors(['login_error' => 'メールアドレスかパスワードが違います'])
            ->withInput();
    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('menu.services.index');
    }

    public function mypage(){
        return view('user.mypage');
    }
}
