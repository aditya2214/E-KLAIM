@extends('admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            <form action="{{url('storevalue')}}" method="post">
            {{ csrf_field() }}
               <div class="form-group">
                   <input readonly type="hidden" name="id" value="{{$data->id}}">
                    <label for="">Masukan Nilai</label>
                    <input type="number" name="value">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Pastikan Input Dengan Benar?')">Save</button>
               </div>
            </form>
        </div>
    </div>
</div>
@endsection