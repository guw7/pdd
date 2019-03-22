@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h1>Form Tambah Kampung</h1>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">
          <h2>Silahkan Tambah Kampung :</h2>

            @if (count($errors) > 0)
               
              {{ $errors->first('id_kegiatan') }}<br>
              {{ $errors->first('nama_kampung') }}<br>
              {{ $errors->first('nm_gecik') }}<br>
              
            @endif 


      <form action="{{route('kampung.store')}}" method="POST">

      <input type="hidden" name="_token" value="{{csrf_token() }}">
      
      <div class="form-group">
          <label class="col-md-2 control-label">Nama Kampung  :</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="nama_kampung" placeholder="Nama Kampung" required>
          </div>
      </div>

      <div class="form-group">
          <label class="col-md-2 control-label">Nama Geuchik  :</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="nm_gecik" placeholder="Nama Geuchik">
          </div>
      </div>

       <center>
          <input type="submit" class="btn btn-info" value="Tambah">
           <a href="{{route('kampung.index')}}">
          <input type="button" class="btn btn-danger" value="Batal">
        </center>
  
    </form>
     
         </div>
   </div>
</div>
<!-- END PAGE CONTAINER -->
@endsection