<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use App\Models\penjualanDetailModel;
use App\Models\riwayatModel;
use App\Models\stokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RiwayatController extends Controller
{
    public function index() {

        $breadcrumb = (object) [
            'title' => 'Daftar Riwayat Penjualan',
            'list' => ['Home', 'Riwayat Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar riwayat penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'riwayat';

        return view('riwayat.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);
   
    }

    public function list(Request $request)
    {
        $riwayat = riwayatModel::with('user');

        
        return DataTables::of($riwayat)->addIndexColumn()->addColumn('aksi', function ($riwayat) {
            $btn = '<a href="'.url('/riwayat/' . $riwayat->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/riwayat/' . $riwayat->penjualan_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/riwayat/'.$riwayat->penjualan_id).'">'. csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>'; 

            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    //menampilkan halaman form tambah transaksi
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Riwayat',
            'list' => ['Home', 'Riwayat', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah riwayat baru'
        ];

        $barang = stokModel::where('stok_jumlah', '>', 0)->with('barang')->get();
        $user = UserModel::all();
        $activeMenu = 'riwayat';

        return view('riwayat.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    //menampilkan halaman form edit riwayat
    public function edit(string $id)
    {
        $riwayatPenjualan = riwayatModel::find($id);
        $user = UserModel::all();
        $detail = penjualanDetailModel::where('penjualan_id', $id)->first();
        $barang = stokModel::where('stok_jumlah', '>', 0)->with('barang')->get();

        $breadcrumb = (object) [
            'title' => 'Edit Riwayat',
            'list' => ['Home', 'Riwayat', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Riwayat'
        ];

        $activeMenu = 'riwayat';

        return view('riwayat.edit', ['breadcrumb'=> $breadcrumb, 'page' => $page, 'riwayatPenjualan'=> $riwayatPenjualan, 'user' => $user, 'detail' => $detail,'barang' => $barang, 'activeMenu' => $activeMenu]);
    }
    //menampilkan detail riwayat
    public function show(string $id)
    {
        $riwayat = riwayatModel::with('user')->find($id);
        $barangTerjual = penjualanDetailModel::where('penjualan_id', $id)->with('barang')->get();

        $breadcrumb = (object) [
            'title' => 'Detail Riwayat',
            'list' => ['Home', 'Riwayat', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail riwayat'
        ];

        $activeMenu = 'riwayat';
        
        return view('riwayat.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'riwayat' => $riwayat, 'barangTerjual' => $barangTerjual, 'activeMenu' => $activeMenu]);
    }
    //menyimpan data riwayat baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'user_id' => 'required|integer',
            'pembeli' => 'required|string',
            'penjualan_kode' => 'required|string',
            'penjualan_tanggal' => 'required|date',
        ]);

        $barang = barangModel::all();
    

        DB::beginTransaction();

        $riwayat = riwayatModel::create($request->all());


        $barangLaku = $request->only('barang_id');


        foreach ($barangLaku as $key => $item) {

            penjualanDetailModel::create([
                'penjualan_id' => $riwayat->penjualan_id,
                'barang_id' => $item[0],
                'harga' => $barang->find($item[0])->harga_jual,
                'jumlah' => 1,
            ]);

            $stok = stokModel::where('barang_id', $item[0])->with('barang')->first();
            $stok->decrement('stok_jumlah', 1);

            if($stok->stok_jumlah < 0 ){
            return back()->with('error', 'Stok '.$stok->barang_nama.' Tidak Mencukupi');
            }
        }

        DB::commit();

        return redirect('/riwayat')->with('success', 'Data riwayat berhasil disimpan');
    }
    //menyimpan perubahan data riwayat
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'nullable|array',
            'user_id' => 'nullable|integer',
            'pembeli' => 'nullable|string',
            'penjualan_kode' => 'nullable|string',
            'penjualan_tanggal' => 'nullable|date',
        ]);
        DB::beginTransaction();


        $riwayat = riwayatModel::find($id);
        $riwayat->update($request->all());
        $barang = barangModel::all();


        $barangLaku = $request->only('barang_id');

        if(count($barangLaku) > 0){
            penjualanDetailModel::where('penjualan_id', $id)->delete();

            foreach ($barangLaku as $key => $item) {

                PenjualanDetailModel::create([
                    'penjualan_id' => $riwayat->penjualan_id,
                    'barang_id' => $item[0],
                    'harga' => $barang->find($item[0])->harga_jual,
                    'jumlah' => 1,
                ]);
    
                $stok = stokModel::where('barang_id', $item[0])->with('barang')->first();
                $stok->decrement('stok_jumlah', 1);
    
                if($stok->stok_jumlah < 0 ){
                return back()->with('error', 'Stok '.$stok->barang_nama.' Tidak Mencukupi');
                }
            }
        }

        DB::commit();

        return redirect('/riwayat')->with('success', 'Data penjualan berhasil diubah');
    }
    //menghapus data riwayat
    public function destroy(string $id)
    {
        $check = riwayatModel::find($id);
        if (!$check) {
            return redirect('/riwayat')->with('error', 'Data riwayat tidak ditemukan');
        }

        try{
            $penjualanDetail = penjualanDetailModel::where('penjualan_id', $id)->get();
            foreach ($penjualanDetail as $key => $value) {
                $value->delete();
            }
            riwayatModel::destroy($id);

            return redirect('/riwayat')->with('success', 'Data riwayat berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect('/riwayat')->with('error', 'Data riwayat gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
