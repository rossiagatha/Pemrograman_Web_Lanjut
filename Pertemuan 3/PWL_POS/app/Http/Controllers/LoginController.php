<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    function index(){
        return view('login');
    }
    function login(Request $request){

        // $credentials = $request->validate([
        //     'username' => ['required'],
        //     'password' => ['required'],
        // ]);
 
        // if (Auth::attempt($credentials)) {
        //     $user = UserModel::where('username', $credentials['username'])->first();
            
        //     if($user->status == 0)  return back()->withErrors(['status' => 'Akun Anda belum divalidasi.']);

        //     $request->session()->regenerate();
 
        //     return redirect()->route('dashboard');
        // }
 
        // return back()->withErrors([
        //     'authentication' => 'Username/Password salah',
        // ])->onlyInput('username');
        
        $infologin = $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required'=>'Username wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'username'=>$request->username,
            'password'=>$request->password,
        ];

        
        if (Auth::attempt($infologin)) {
            $user = UserModel::where('username', $infologin['username'])->first();
            if ($user->status_validasi==0) {
                return back()->withErrors(['status'=>'Akun anda belum di validasi']);
            }
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }else {
            return redirect('/login')->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }
    }
    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/login');
}

    public function register(){
        return view('register');
    }

    public function storeMember(Request $request): RedirectResponse //: RedirectResponse is return type
    {
        $newUser = $request->validate([
            'username' => ['required', 'unique:m_user,username'],
            'nama' => ['required'],
            'password' => ['required', 'max:5'],
            'confirm_password' => ['required', 'same:password'],
            'profil_img' => ['required', 'mimes:png,jpg,jpeg', 'max:1024'],
        ]);

        $newUser['level_id'] = 4;
        $newUser['status'] = 0;

        try {

            // Store profile image
            $profileImg = $newUser['profil_img'];
            $profileName = Str::random(10).$newUser['profil_img']->getClientOriginalName();
            $profileImg->storeAs('public/profil', $profileName);


            // Overide profile_img name
             $newUser['profil_img'] = $profileName;
             $newUser['password'] = bcrypt($request->password);

            UserModel::create($newUser);

            return redirect()->route('login')->with('success', 'Berhasil Register');

        } catch (\Throwable $th) {

            return back()->withErrors([
                'error' => $th->getMessage(),
            ]);
        }
    }
}
