<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    // pertemuan 9
    public function index()
    {
        //kita ambil data user lalu simpan pada variabel $user
        $user = Auth::user();

        //kondisi jika user nya ada
        if ($user) {
            //jika usernya memiliki level admin
            if ($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            else if ($user->level == '2') {
                return redirect()->intended('manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        //kita buat validasi pada saat tombol login di klik
        //validasi nya username & password wajib di isi
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //ambil data request username & password saja
        $credentials = $request->only('username', 'password');
        //cek jika data username dan password valid (sesuai) dengan data
        if (Auth::attempt($credentials)) {
            //kalau berhasil simoan data user yg di variabel $user
            $user = Auth::user();

            //cek lagi jika level user admin maka arahkan ke halaman admin
            if ($user->level_id == '1') {
                //dd($user->level_id);
                return redirect()->intended('admin');
            }
            //tapi jika level usernya user biasa maka arahkan ke halaman user
            else if ($user->level_id == '2') {
                return redirect()->intended('manager');
            }
            //jika belum ada role maka ke halaman /
            return redirect()->intended('/');
        }
        //jika ga ada data user yang valid maka kembalikan lagi ke halaman login
        //pastikan kirim pesan error juga kalau login gagal ya
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukkan sudah benar']);
    }

    public function register()
    {
        //tampilkan view register
        return view('register');
    }
    //aksi form register
    public function proses_register(Request $request)
    {
        //kita buat validasi nih buat proses register
        //validasinya yaitu semua field wajib di isi
        //validasi username itu harus unique atau tidak boleh duplicate username ya
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required'
        ]);

        //kalau gagal kembali ke halaman register dengan munculkan pesan error
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        $newUser = $request->all();
        $newUser['level_id'] = '2';
        //kalau berhasil isi level & hash passwordnya ya biar secure
        $newUser['password'] = Hash::make($request->password);

        //masukkan semua data pada request ke table user
        UserModel::create($newUser);

        //kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        //logout itu harus menghapus session nya
        $request->session()->flush();

        //jalankan juga fungsi logout pada auth
        Auth::logout();

        //kembalikan ke halaman login
        return redirect('login');
    }


    // public function index(){
    //     return view('login');
    // }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->withErrors(['username' => 'Invalid username or password']);
    }
    // public function logout() {
    //     Auth::logout();
    //     return redirect('/');
    // }
}