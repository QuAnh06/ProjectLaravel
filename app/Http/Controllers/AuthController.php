<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $dataLogin = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ], [
        'email.exists' => 'Email này không tồn tại trong hệ thống.'
    ]);

        if (Auth::attempt($dataLogin)) {
            $request->session()->regenerate();
            return redirect()->intended('index'); 
        }

        return back()->withErrors(['password' => 'Mật khẩu cung cấp không chính xác.'])->withInput();
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'status' => 1,
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, mời bạn đăng nhập!');
    }

    public function logout(Request $request) {
        // dd('Đã chạy vào hàm Logout thành công!');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }    
    
}
