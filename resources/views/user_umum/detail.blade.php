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
                @if($reg->name_file==null)
                <li class="list-group-item">Dokumen Pendukung   : <label for="" class="label label-danger">Anda Belum Upload Document Pendukung</label></li>
                @else
                <li class="list-group-item">Dokumen Pendukung   : <img style="display: block; margin-left: auto; margin-right: auto;" src="{{url('storage/'.$reg->name_file)}}" width="750px;" height="850px;" alt=""></li>
                @endif
                @if($reg->name_file==null)
                <li class="list-group-item">detail_pembayaran   : <label for="" class="label label-danger">Mohon Upload Document Pendukung</label></li>
                @elseif($reg->bukti_pembayaran==null)
                <li class="list-group-item">detail_pembayaran   : <label for="" class="label label-warning">Masih Dalam Proses</label></li>
                @else
                <li class="list-group-item">detail_pembayaran   : Sudah Di Bayarkan<br><img style="display: block; margin-left: auto; margin-right: auto;" src="{{url('storage/'.$reg->bukti_pembayaran)}}" width="750px;" height="850px;" alt=""></li>
                @endif
            </ul>
        </div>
    </div>
</div>

@endsection