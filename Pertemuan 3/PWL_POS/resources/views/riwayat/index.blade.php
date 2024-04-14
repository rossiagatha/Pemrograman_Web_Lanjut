@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('riwayat/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_riwayat">
                <thead>
                    <tr><th>ID Penjualan</th><th>Staff Penjualan</th><th>Nama Pembeli</th><th>Kode Penjualan</th><th>Tanggal Penjualan</th><th>Aksi</th></tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataBarang = $('#table_riwayat').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('riwayat/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d){
                        d.user_id = $('#user_id').val();
                    }
                    
                },
                columns: [
                    {
                        data: "penjualan_id",
                        className: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "user.nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "pembeli",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "penjualan_kode",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "penjualan_tanggal",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#barang_id', '#user_id').on('change', function(){
                dataBarang.ajax.reload();
            }) 
        });
    </script>
@endpush