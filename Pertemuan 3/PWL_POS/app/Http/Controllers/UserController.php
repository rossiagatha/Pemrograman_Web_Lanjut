<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index() {
        // tambah data user dengan Eloquent Model
        //$data =[
            //'nama' => 'Pelanggan Pertama',
        //];

        //UserModel::where('username', 'customer-1')->update($data); //update data user
        //coba akses model UserModel
        //$user = UserModel::all(); //ambil semua data dari tabel m_user
        //return view('user', ['data' => $user]);

        //pertemuan 4 praktikum 1
        //$data =[
            //'level_id' => 2,
            //'username' => 'manager_dua',
            //'nama' => 'Manager 2',
            //'username' => 'manager_tigas',
            //'nama' => 'Manager 3',
            //'password' => Hash::make('12345')
        //];
        //UserModel::create($data);

        //$user = UserModel::all();
        //return view('user', ['data' => $user]);

        //pertemuan 4 praktikum 2.1
        //$user = UserModel::find(1);
        //$user = UserModel::where('level_id', 1)->first();
        //$user = UserModel::firstWhere('level_id', 1);
        //$user = UserModel::findOr(1, ['username', 'nama'], function () {
            //abort(404);
        //});
        //$user = UserModel::findOr(20, ['username', 'nama'], function () {
            //abort(404);
        //});
        //return view('user', ['data' => $user]);

        //pertemuan 4 praktikum 2.2
        //$user = UserModel::findOrFail(1);
        //return view('user', ['data' => $user]);

        //pertemuan 4 praktikum 2.3
        //$user = UserModel::where('level_id', 2)->count();
        //dd($user);
        //return view('user', ['data' => $user]);

        //pertemuan 4 praktikum 2.4
        //$user = UserModel::firstOrCreate(
            //[
                //'username' => 'manager',
                //'nama' => 'Manager',
                //'username' => 'manager22',
                //'nama' => 'Manager Dua Dua',
                //'password' => Hash::make('12345'),
                //'level_id' => 2
            //],
       //);
        //return view('user', ['data' => $user]);

        //$user = UserModel::firstOrNew(
            //[
                //'username' => 'manager',
                //'nama' => 'Manager',
                //'username' => 'manager33',
                //'nama' => 'Manager Tiga Tiga',
                //'password' => Hash::make('12345'),
                //'level_id' => 2
            //],
        //);
        //$user->save();

        //return view('user', ['data' => $user]);

        //pertemuan 4 praktikum 2.5
        //$user = UserModel::create([
            //'username' => 'manager55',
            //'nama' => 'Manager55',
            //'password' => Hash::make('12345'),
            //'level_id' => 2,
        //]);

        //$user->username = 'manager 56';

        //$user->isDirty(); //true
        //$user->isDirty('username'); //true
        //$user->isDirty('nama'); //false
        //$user->isDirty(['nama', 'username']); //true

        //$user->isClean(); //false
        //$user->isClean('username'); //false
        //$user->isClean('nama'); //true
        //$user->isClean(['nama', 'username']); //false

        //$user->save();

        //$user->isDirty(); //false
        //$user->isClean(); //true
        //dd($user->isDirty());

        //$user = UserModel::create([
            //'username' => 'manager11',
            //'nama' => 'Manager11',
            //'password' => Hash::make('12345'),
            //'level_id' => 2,
        //]);

        //$user->username = 'manager 12';

        //$user->save();

        //$user->wasChanged(); //true
        //$user->wasChanged('username'); //true
        //$user->wasChanged(['username', 'level_id']); //true
        //$user->wasChanged('nama'); //false
        //dd($user->wasChanged(['nama', 'username'])); //true

        //pertemuan 4 praktikum 2.6
        //$user = UserModel::with('level')->get();
        //return view('user', ['data' => $user]);

        //pertemuan 7
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $users = Usermodel::select('user_id', 'username', 'nama', 'level_id')->with('level');

        //filter data user berdaarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }
        
        return DataTables::of($users)->addIndexColumn()->addColumn('aksi', function ($user) {
            $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>'; 

            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    //menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    //menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user, username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    //menampilkan detail user
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user';
        
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    //menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User'
        ];

        $activeMenu = 'user';

        return view('user.edit', ['breadcrumb'=> $breadcrumb, 'page' => $page, 'user'=> $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }
    //menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    //menghapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try{
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect('/user')->with('error', 'Data user gagal dihapus karenamasih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function validateUser($id)
    {
        // Lakukan validasi user berdasarkan $id yang diterima dari URL
        $user = UserModel::find($id);

        if (!$user) {
            // Tampilkan pesan jika user tidak ditemukan
            return back()->withErrors('User tidak ditemukan.');
        }

        // Lakukan proses validasi user
        $user->status = 1; // Misalnya, ubah status user menjadi "divalidasi"
        $user->save();

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect('/user')->with('success', 'User berhasil divalidasi.');
    }
//     public function showregis()
// {
//     $members = UserModel::where('status_validasi', 0)->get();


//     $breadcrumb = (object) [
//         'title' => 'Edit User',
//         'list' => ['Home', 'Members']
//     ];

//     $page = (object) [
//         'title' => 'Edit User'
//     ];

//     $activeMenu = 'user';
// dd($members);
//     return view('welcome', ['breadcrumb'=> $breadcrumb, 'page' => $page, 'members'=> $members, 'activeMenu' => $activeMenu]);
// }

//     //public function tambah() {
      //  return view('user_tambah');
   // }

    //public function tambah_simpan(Request $request) {
      //  UserModel::create([
        //    'username' => $request->username,
          //  'nama' => $request->nama,
            //'password' => Hash::make('$request->password'),
            //'level_id' => $request->level_id
        //]);

        // return redirect('/user');
   // }

   // public function ubah($id) {
     //   $user = UserModel::find($id);
       // return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request) {
       // $user = UserModel::find($id);

        // $user->username = $request->username;
        // $user->nama = $request->nama;
        // $user->password = Hash::make('$request->password');
        // $user->level_id = $request->level_id;

        // $user->save();

        // return redirect('/user');
   // }

   // public function hapus($id) {
     //   $user = UserModel::find($id);
      //  $user->delete();

       // return redirect('/user');
   // }

}
