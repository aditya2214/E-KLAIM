@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">REGISTRASI E-KLAIM</div>
                <div class="panel-body">
                    <form action="{{url('upload_dokumen_pendukung/save')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input name="id" type="hidden" class="form-control" value="{{$data->id}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Dokument Pendukung:</label>
                            <input name="image" type="file" class="form-control">
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