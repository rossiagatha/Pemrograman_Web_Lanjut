<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;
use App\Models\barangModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) {
       /* $data = [
            'kategori_kode' => 'MK',
            'kategori_nama' => 'Makanan',
            'created_at' => now()
        ];
        DB::table('m_kategori')->insert($data);
        return 'Insert data baru berhasil'; */

        // $row = DB::table('m_kategori')->where('kategori_kode', 'MK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: '. $row.' baris ';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'MK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row.' baris';

        //$data = DB::table('m_kategori')->get();
        //return view('kategori', ['data' => $data]);

        // return $dataTable->render('kategori.index');

        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori';
        $members = UserModel::where('status_validasi', 0)->get();

        return view('kategori', ['breadcrumb' => $breadcrumb, 'members' => $members ,'page' => $page,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $kategori = KategoriModel::withCount('barang')->get();
        
        return DataTables::of($kategori)->addIndexColumn()->addColumn('aksi', function ($kategori) {
            $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/kategori/'.$kategori->kategori_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>'; 

            return $btn;
        })
        ->addColumn('total_barang', function ($kategori) {
            return $kategori->barang_count;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'kategori';
        $members = UserModel::where('status_validasi', 0)->get();

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'members' => $members ,'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);
        $barang = barangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kategori'
        ];

        $activeMenu = 'kategori';
        $members = UserModel::where('status_validasi', 0)->get();

        return view('kategori.edit', ['breadcrumb'=> $breadcrumb, 'members' => $members ,'page' => $page, 'kategori'=> $kategori, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    //menampilkan detail kategori
    public function show(string $id)
    {
        $kategori = KategoriModel::with('barang')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori';
        $members = UserModel::where('status_validasi', 0)->get();
        
        return view('kategori.show', ['breadcrumb' => $breadcrumb, 'members' => $members ,'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    //menyimpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|min:2|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100'
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    //menyimpan perubahan data kategori
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|min:2|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100'
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    //menghapus data kategori
    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data barang tidak ditemukan');
        }

        try{
          KategoriModel::destroy($id);

            return redirect('/kategori')->with('success', 'Data barang berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect('/kategori')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    /* public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,

        ]);
        return redirect('/kategori');
    }*/
}
