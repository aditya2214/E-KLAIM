@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
            <div class="panel panel-default">
                <div class="panel-heading">REGISTRASI E-KLAIM</div>
                <div class="panel-body">
                    <form action="{{url('registrasi/save')}}" method="post">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Nomor Polis:</label>
                            <input required name="no_polis" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal kejadian:</label>
                            <input required name="tgl_kejadian" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Waktu kejadian:</label>
                            <input required name="waktu_kejadian" type="time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Penyebab:</label>
                            <input required name="penyebab" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi kejadian:</label>
                            <input required name="deskripsi_kejadian" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Estimasi kerugian:</label>
                            <input required name="estimasi_kerugian" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor rekening:</label>
                            <input required name="no_rek" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nama bank:</label>
                            <input required name="nm_bank" type="text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>

@endsection
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(900, 0).slideUp(900, function(){
      $(this).remove(); 
    });
  }, 9000);
</script>