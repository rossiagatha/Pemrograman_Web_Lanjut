<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index() {
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        //$row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        //return 'update data berhasil. Jumlah data yang diupdate: ' . $row.'baris';

        //$row = DB::delete('delete from m_level where level_kode =?', ['CUS']);
        //return 'Delete data berhasil. Jumlah data yang dihapus: '.$row.' baris';

        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';

        return view('level.level', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);

        // $data = DB::select('select * from m_level');
        // return view('level', ['data' => $data]);
    }

    public function list(Request $request)
    {
        $level = LevelModel::all();

        
        return DataTables::of($level)->addIndexColumn()->addColumn('aksi', function ($level) {
            $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/level/'.$level->level_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>'; 

            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }
    //menampilkan halaman form tambah level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'level';

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    //menyimpan perubahan data level
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }
    //menampilkan halaman form edit level
    public function edit(string $id)
    {
        $level = LevelModel::find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', ['breadcrumb'=> $breadcrumb, 'page' => $page, 'level'=> $level, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    //menampilkan detail lavel
    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level';
        
        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

     //menyimpan data barang baru
     public function store(Request $request)
     {
         $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
         ]);
 
         LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
         ]);
 
         return redirect('/level')->with('success', 'Data level berhasil disimpan');
     }

     //menghapus data barang
    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try{
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
