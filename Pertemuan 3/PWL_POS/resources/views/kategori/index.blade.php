@extends('layouts.template')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Kategori</div>
            <div class="card-body">
               <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr><th>ID Barang</th><th>Kode Barang</th><th>Nama Barang</th><th>Harga Beli</th><th>Harga Jual</th><th>Kategori</th><th>Aksi</th></tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
