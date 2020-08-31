@extends('admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul style="margin:40px;" class="list-group">
                <li class="list-group-item">No Polis            : {{$data_no->no_polis}}</li>
                <li class="list-group-item">tgl_kejadian        : {{$data_no->tgl_kejadian}}</li>
                <li class="list-group-item">waktu_kejadian      : {{$data_no->waktu_kejadian}}</li>
                <li class="list-group-item">penyebab            : {{$data_no->penyebab}}</li>
                <li class="list-group-item">deskripsi_kejadian  : {{$data_no->deskripsi_kejadian}}</li>
                <li class="list-group-item">estimasi_kerugian   : {{$data_no->estimasi_kerugian}}</li>
                <li class="list-group-item">no_klaim            : {{$data_no->no_klaim}}</li>
                <li class="list-group-item">tgl_kejadian        : {{$data_no->tgl_kejadian}}</li>
                <li class="list-group-item">status              : {{$data_no->status}}</li>
                <li class="list-group-item">created_at          : {{$data_no->created_at}}</li>
                <li class="list-group-item">name_file           : <img style="margin:30px;" src="{{url('storage/'.$data_no->name_file)}}" width="750px" height="850px" alt=""></li>
            </ul>
        </div>
    </div>
</div>

@endsection