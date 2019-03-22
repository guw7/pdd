@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h1>Form Edit Komentar</h1>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">

          <h2>Silahkan Edit Komentar :</h2>


        @if (count($errors) > 0)
           
                  {{ $errors->first('user_id') }}<br>
                  {{ $errors->first('id_kegiatan') }}<br>
                  {{ $errors->first('komen') }}<br>
                  {{ $errors->first('foto') }}<br>
        @endif 


        <form action="{{route('komentar.update', $komentar->id)}}" method="POST">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="_method" value="PATCH">
          
            <div class="form-group">
              <label class="col-md-2 control-label">Nama User</label>
              <div class="col-md-6">
                  <input type="text" name="nama" class="form-control" value="{{$komentar->nama}}" disabled="true">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Nama Kegiatan</label>
              <div class="col-md-6">
                  <input type="text" name="nama_kegiatan" class="form-control" value="{{$komentar->nama_kegiatan}}" disabled="true">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Komentar</label>
              <div class="col-md-6">
                  <input type="text" name="komen" class="form-control" value="{{$komentar->komen}}">
              </div>
            </div>

             <div class="form-group">
              <label class="col-md-2 control-label">Foto</label>
              <div class="col-md-6">
                <input type="file" name="foto"> {{$komentar->foto}}
              </div>
            </div>

            <center>
              <input type="submit" class="btn btn-info" value="Edit Data">
              <a href="{{route('komentar.index')}}">
              <input type="button" class="btn btn-danger" value="Batal "></a>
            </center>
      
        </form>

      </div>
   </div>
</div>  
<!-- END PAGE CONTAINER -->
    
@endsection