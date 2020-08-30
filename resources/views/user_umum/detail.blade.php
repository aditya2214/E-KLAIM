@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item">No Polis            : {{$reg->no_polis}}</li>
                <li class="list-group-item">tgl_kejadian        : {{$reg->tgl_kejadian}}</li>
                <li class="list-group-item">waktu_kejadian      : {{$reg->waktu_kejadian}}</li>
                <li class="list-group-item">penyebab            : {{$reg->penyebab}}</li>
                <li class="list-group-item">deskripsi_kejadian  : {{$reg->deskripsi_kejadian}}</li>
                <li class="list-group-item">estimasi_kerugian   : {{$reg->estimasi_kerugian}}</li>
                <li class="list-group-item">no_klaim            : {{$reg->no_klaim}}</li>
                <li class="list-group-item">tgl_kejadian        : {{$reg->tgl_kejadian}}</li>
                <li class="list-group-item">status              : {{$reg->status}}</li>
                <li class="list-group-item">created_at          : {{$reg->created_at}}</li>
                <li class="list-group-item">name_file           : <img src="{{url('storage/'.$reg->name_file)}}" width="100px" height="100px" alt=""></li>
            </ul>
        </div>
    </div>
</div>

@endsection