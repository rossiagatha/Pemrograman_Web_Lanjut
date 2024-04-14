<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->withErrors(['username' => 'Invalid username or password']);
    }
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}