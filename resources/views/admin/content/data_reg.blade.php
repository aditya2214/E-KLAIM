@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Data Registrasi Klaim</h3></div>
                    <br><br>
                    @if ($message = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="panel-body">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>no_polis</th>
                                    <th>tgl_kejadian</th>
                                    <th>waktu_kejadian</th>
                                    <th>penyebab</th>
                                    <th>deskripsi_kejadian</th>
                                    <th>estimasi_kerugian</th>
                                    <th>no_rek</th>
                                    <th>nm_bank</th>
                                    <th>no_klaim</th>
                                    <th>status</th>
                                    <th>created_at</th>
                                    <th>name_file</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reg as $r)
                                <tr>
                                    <td><a  href="{{url('approved/'.$r->no_polis)}}" ><i class="fas fa-hammer"></i></a></td>
                                    <td><a href="{{url('detail_no/'.$r->no_polis)}}">{{$r->no_polis}}</a></td>
                                    <td>{{$r->tgl_kejadian}}</td>
                                    <td>{{$r->waktu_kejadian}}</td>
                                    <td>{{$r->penyebab}}</td>
                                    <td>{{$r->deskripsi_kejadian}}</td>
                                    <td>{{$r->estimasi_kerugian}}</td>
                                    <td>{{$r->no_rek}}</td>
                                    <td>{{$r->nm_bank}}</td>
                                    <td>{{$r->no_klaim}}</td>
                                    @if($r->status==0)
                                    <td><i class="fas fa-user-clock"></i></td>
                                    @elseif($r->status==1)
                                    <td><i class="fas fa-user-check"></i></td>
                                    @endif
                                    <td>{{$r->created_at}}</td>
                                    <td><img src="{{url('storage/'.$r->name_file)}}" width="100px" height="100px" alt=""></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 5000);
</script>