@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h1>Form Edit User</h1>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">
      
          <h2>Silahkan Edit data anda :</h2>


		@if (count($errors) > 0)
			 
			{{ $errors->first('nama') }}<br>
			{{ $errors->first('username') }}<br>
     	{{ $errors->first('email') }}<br>
			
		@endif 


    		<form action="{{route('user.update', $user->id)}}" method="POST" class="form-horizontal">

    			<input type="hidden" name="_token" value="{{csrf_token()}}">
    			<input type="hidden" name="_method" value="PATCH">
    		
    		<div class="form-group">
                <label class="col-md-2 control-label">Nama</label>
                <div class="col-md-6">
                	<input type="text" class="form-control" name="nama" placeholder="Nama Anda" value="{{$user->nama}}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Username</label>
                <div class="col-md-6">
                	<input type="text" class="form-control" name="username" placeholder="Username" value="{{$user->username}}" />
                </div>
            </div>
    			
            <div class="form-group">
                <label class="col-md-2 control-label">E-Mail</label>
                <div class="col-md-6">
                	<input type="email" class="form-control" name="email" placeholder="Alamat Email" value="{{$user->email}}" />
                </div>
            </div>

            <center>
              <input type="submit" class="btn btn-info" value="Edit Data">
        			<input type="reset" class="btn btn-danger" value="Cancel">
            </center>
        </form>

         </div>
   </div>
</div>  
<!-- END PAGE CONTAINER -->
		
@endsection
