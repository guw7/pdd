@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h5>Tambah Data</h5>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">

          <h2>Silahkan masukkan data anda :</h2>

        		@if (count($errors) > 0)
        			 
        			{{ $errors->first('nama') }}<br>
        			{{ $errors->first('username') }}<br>
        			{{ $errors->first('email') }}<br>
        			{{ $errors->first('password') }}<br>
        			
        		@endif 

		  <form action="{{route('user.store')}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token() }}">
			
			Nama		: <input type="text" name="nama" placeholder="Nama Anda"><br><br>
			Username	: <input type="text" name="username" placeholder="Username"><br><br>
      E-mail    : <input type="email" name="email" placeholder="Alamat Email"><br><br>
			Password 	: <input type="password" name="password" placeholder="Password"><br>
          
			<p>	<input type="submit" value="Tambah Data"> </p>
	
		</form>
    </div>
   </div>
</div>
<!-- END PAGE CONTAINER -->

		

@endsection