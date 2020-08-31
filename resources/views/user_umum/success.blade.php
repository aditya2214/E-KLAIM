@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <p style="color:white">1. Search : Colom Untuk Mencari Document Anda</p>
            <p style="color:white">1. Klik Bagian Nomor Polis : Untuk Melihat Detail Dokumen Anda</p>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Check Status Dokumen</div>
                    @if ($message = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                <div class="panel-body" style="overflow-x:auto;">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nomor Polis</th>
                                <th>Tanggal kejadian</th>
                                <th>Waktu kejadian</th>
                                <th>Status</th>
                                <th>Di Buat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_klaim as $d)
                            <tr>
                                <td><a href="{{url('detail_reg/'.$d->no_polis)}}">{{$d->no_polis}}</a></td>
                                <td>{{$d->tgl_kejadian}}</td>
                                <td>{{$d->waktu_kejadian}}</td>
                                @if($d->status==0)
                                <td><label for="" class="label label-danger">Dokument Dalam Proses</label></td>
                                @elseif($d->status==1)
                                <td><label for="" class="label label-success">Dokument Sudah Di Setujui</label></td>
                                @endif
                                <td>{{$d->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/datatable.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#dataTable').DataTable();
    });
</script>
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 5000);
</script>
@endsection