@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr><th>ID Stok</th><th>Nama Barang</th><th>Nama Penyetok</th><th>Tanggal Stok</th><th>Jumlah Stok</th><th>Aksi</th></tr>
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
            var dataBarang = $('#table_stok').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('stok/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d){
                        d.barang_id = $('#barang_id').val();
                        d.user_id = $('#user_id').val();
                    }
                    
                },
                columns: [
                    {
                        data: "stok_id",
                        className: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "barang.barang_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "user.nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "stok_tanggal",
                        className: "",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                        if (data) {
                        var date = new Date(data);
                        var year = date.getFullYear().toString();
                        var month = ('0' + (date.getMonth() + 1)).slice(-2);
                        var day = ('0' + date.getDate()).slice(-2);
                        return day + '-' + month + '-' + year;
                        }
                        return '';
                    }, 
                    },{
                        data: "stok_jumlah",
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