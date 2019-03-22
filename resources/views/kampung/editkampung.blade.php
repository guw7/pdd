@extends('home')

@section('content')
<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h1>Form Edit Kampung</h1>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">

          <h2>Silahkan Edit Kampung:</h2>


    @if (count($errors) > 0)
       
      {{ $errors->first('id_kegiatan') }}<br>
      {{ $errors->first('nama_kampung') }}<br>
      {{ $errors->first('nm_gecik') }}<br>
      
    @endif 


      <form action="{{route('kampung.update', $kampung->id)}}" method="POST">

      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <input type="hidden" name="_method" value="PATCH">
      
     
      <br><br>
   
        <div class="form-group">
            <label class="col-md-2 control-label">Nama Kampung :</label>
            <div class="col-md-6">
               <input type="text" class="form-control" name="nama_kampung" placeholder="Nama Kampung" value="{{$kampung->nama_kampung}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Nama Geuchik :</label>
            <div class="col-md-6">
               <input type="text" class="form-control" name="nm_gecik" placeholder="Nama Geuchik" value="{{$kampung->nm_gecik}}">
            </div>
        </div>

       <center>
          <input type="submit" class="btn btn-info" value="Edit Data">
          <a href="{{route('kampung.index')}}">
          <input type="button" class="btn btn-danger" value="Batal"></a>
        </center>
  
    </form>
       
         </div>
   </div>
</div>
<!-- END PAGE CONTAINER -->
    
@endsection
