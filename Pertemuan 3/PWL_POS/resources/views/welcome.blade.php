@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Hallo, Apakabar !</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @if (auth()->user()->level->level_nama != 'Member')
            <div class="chartwraper">
                {!! $chart->container() !!}
            </div>
            <div class="tablewraper">
                
                <div class="btnnwraper d-flex justify-content-end mb-3">
                    <a href="{{route('exportPdf')}}" class="btn btn-danger mr-2">Eksport PDF</a>
                    <a href="{{route('exportExcel')}}" class="btn btn-success mr-2">Eksport Excel</a>
                </div>
                <div class="title">
                    <strong>List Member yang Belum Tervalidasi</strong>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <body>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->username }}</td>
                                <td>{{ $member->nama }}</td>
                                <td>
                                    @if($member->status == 0 && $member->user_id)
                                        <form action="{{ route('validateStatus', $member->user_id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-success">Validasi</button>
                                        </form>
                                    @elseif($member->status == 0 && !$member->user_id)
                                        <span class="badge badge-danger">ID Tidak Tersedia</span>
                                    @else
                                        <span class="badge badge-success">Sudah divalidasi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </body>
                </table>
            </div>
            <div class="tablewraper mt-5">
                <div class="title">
                    <strong>List User yang Sudah Tervalidasi</strong>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($membersValidasi as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->status ? 'Tervalidasi' : 'Sudah Tervalidasi' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
            @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{ auth()->user()->user_id }}</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>{{ auth()->user()->level->level_nama }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ auth()->user()->username }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ auth()->user()->status_validasi== 1? 'Tervalidasi':'Tidak Tervalidasi' }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ auth()->user()->nama }}</td>
                </tr>
                <tr>
                    <th>Foto Profil</th>
                    <td><img src="{{ asset('storage/profil/'.auth()->user()->profil_img) }}" alt="foto"></td>
                </tr>
            </table>   
            @endif
            
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endpush