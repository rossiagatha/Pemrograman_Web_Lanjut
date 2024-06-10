<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\Barang;
use App\Model\BarangModel;
use App\Models\barangModel as ModelsBarangModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index() {

        //pertemuan 7
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';
        $members = UserModel::where('status_validasi', 0)->get();

        $kategori = KategoriModel::all();

        return view('barang.index', ['breadcrumb' => $breadcrumb,'members' => $members , 'page' => $page, 'kategori' => $kategori,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $barang = ModelsBarangModel::with('kategori');
        
        //filter data barang berdasarkan level_id
        if ($request->kategori_id) {
            $barang->where('kategori_id', $request->kategori_id);
        }
        
        return DataTables::of($barang)->addIndexColumn()->addColumn('aksi', function ($barang) {
            $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/barang/'.$barang->barang_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>'; 

            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    //menampilkan halaman form tambah barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'barang';
        $lastBarang = ModelsBarangModel::latest('barang_id')->first();
        $lastId = $lastBarang ? $lastBarang->barang_id : 0;
        $members = UserModel::where('status_validasi', 0)->get();

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'members' => $members ,'page' => $page, 'kategori' => $kategori, 'lastId' => $lastId,'activeMenu' => $activeMenu]);
    }

    //menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            // 'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'barang_gambar' => 'required|mimes:jpg,png,jpeg',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer'
        ]);
        $barangName = $request->barang_gambar->hashName();
        $imgFile = $request->barang_gambar;
        $imgFile->storeAs('/public/barangImg/', $barangName);
        $kodeBarang = (ModelsBarangModel::count()+ 1).'/'.Carbon::now()->format('d-m-Y');

        ModelsBarangModel::create([
            'barang_kode' => $kodeBarang,
            'barang_nama' => $request->barang_nama,
            'barang_gambar' => $barangName,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    //menampilkan detail barang
    public function show(string $id)
    {
        $barang = ModelsBarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';
        $members = UserModel::where('status_validasi', 0)->get();
        
        return view('barang.show', ['breadcrumb' => $breadcrumb, 'members' => $members ,'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    //menampilkan halaman form edit barang
    public function edit(string $id)
    {
        $barang = ModelsBarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';
        $members = UserModel::where('status_validasi', 0)->get();

        return view('barang.edit', ['breadcrumb'=> $breadcrumb,'members' => $members , 'page' => $page, 'barang'=> $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }
    //menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode,'.$id.',barang_id',
            'barang_nama' => 'required|string|max:100',
            'barang_gambar' => 'nullable|mimes:jpg,png,jpeg',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer',
        ]);
        if ($request -> barang_gambar) {
            $barangName = $request->barang_gambar->hashName();
            $imgFile = $request->barang_gambar;
            $imgFile->storeAs('/public/barangImg/', $barangName);
        }
        $oldData=ModelsBarangModel::find($id);

        $oldData->update([
            // 'barang_kode' => $request->barang_kode,
            'barang_gambar' => $request->barang_gambar ? $barangName:$oldData->barang_gambar,
            'barang _nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    //menghapus data barang
    public function destroy(string $id)
    {
        $check = ModelsBarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try{
            ModelsBarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    //public function tambah() {
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
