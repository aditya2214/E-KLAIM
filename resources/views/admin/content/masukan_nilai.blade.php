@extends('admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <br><br>
            <form action="{{url('storevalue')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
               <div style="margin:left:10px;" class="form-group">
                    <input readonly type="hidden" name="id" value="{{$data->id}}">
                    <label for="">Masukan Nilai</label>
                    <input type="number" class="form-control" name="value"><br>
                    <label for="">Input Bukti Pembayaran</label>
                    <input type="file" name="image" class="form-control"><br>
                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Pastikan Input Dengan Benar?')">Save</button>
               </div>
            </form>
        </div>
        <div class="col-md-9">
            <ul style="margin:40px;" class="list-group">
                <li class="list-group-item">No Polis            : {{$data->no_polis}}</li>
                <li class="list-group-item">tgl_kejadian        : {{$data->tgl_kejadian}}</li>
                <li class="list-group-item">waktu_kejadian      : {{$data->waktu_kejadian}}</li>
                <li class="list-group-item">penyebab            : {{$data->penyebab}}</li>
                <li class="list-group-item">deskripsi_kejadian  : {{$data->deskripsi_kejadian}}</li>
                <li class="list-group-item">estimasi_kerugian   : {{$data->estimasi_kerugian}}</li>
                <li class="list-group-item">no_klaim            : {{$data->no_klaim}}</li>
                <li class="list-group-item">tgl_kejadian        : {{$data->tgl_kejadian}}</li>
                <li class="list-group-item">status              : {{$data->status}}</li>
                <li class="list-group-item">created_at          : {{$data->created_at}}</li></ul>
        </div>
    </div>
</div>
@endsection