@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($riwayat)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                @else
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <tr>
                            <th>ID</th>
                            <td>{{ $riwayat->penjualan_id }}</td>
                        </tr>
                        <tr>
                            <th>Staff Penjualan</th>
                            <td>{{ $riwayat->user->username }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pembeli</th>
                            <td>{{ $riwayat->pembeli }}</td>
                        </tr>
                        <tr>
                            <th>Barang Terjual</th>
                            <td>
                                <ul>
                                    @foreach ($barangTerjual as $item)
                                        <li>{{$item->barang->barang_nama}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Kode Penjualan</th>
                            <td>{{ $riwayat->penjualan_kode }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Penjualan</th>
                            <td>{{ $riwayat->penjualan_tanggal }}</td>
                        </tr>
                    </table>
            @endempty
            <a href="{{ url('riwayat') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush