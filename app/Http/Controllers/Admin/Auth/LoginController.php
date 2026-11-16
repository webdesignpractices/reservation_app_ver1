<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'staff_code' => ['required'],
            'password' => ['required'],    
            ]);

            if(Auth::guard('admin')->attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            return back()
            ->withErrors(['login_error' => '社員番号かパスワードが違います'])
            ->withInput();
    }


    public function logout(Request $request){

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.dashboard');
    }
}