@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
    
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr><th>ID Kategori</th><th>Kode Kategori</th><th>Nama Kategori</th><th>Total Barang</th><th>Aksi</th></tr>
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
            var dataBarang = $('#table_kategori').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('kategori/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [
                    {
                        data: "kategori_id",
                        className: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "kategori_kode",
                        className: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "kategori_nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "total_barang",
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

            $('#kategori_id').on('change', function(){
                dataBarang.ajax.reload();
            }) 
        });
    </script>
@endpush