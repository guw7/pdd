@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h5>Tabel User</h5>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">
        
          	@if(Session::has('SUCCESS'))
					{{Session::get('SUCCESS')}}
			     @endif
			
			<table class="table table-striped table-bordered datatable-extended">

				<thead>
				<tr>
						<th style="text-align:center">nama</th>
						<th style="text-align:center">username</th>
						<th style="text-align:center">email</th>	
						<th style="text-align:center">action</th>
				</tr>	
				</thead>

				<tbody>

					@foreach ($profile as $user)

					<tr>
						<td>{{$user->nama}}</td>
						<td>{{$user->username}}</td>
			            <td>{{$user->email}}</td>  
						<td>
						
						<form action="{{route('user.destroy', $user->id)}}" method="POST">
						<center>
							<input type="hidden" name="_token" value="{{csrf_token() }}">
							<input type="hidden" name="_method" value="delete">

							<a href="{{route('user.edit',$user->id)}}"> 
							<input type="button" class="btn btn-info"  value="Edit" ></a>
							<input type="submit" name="delete" class="btn btn-danger"  value="Delete" onclick="return confirm('Anda yakin ingin menghapus data ?');" /> 
						</center>
						</form>
							
						</td>
					</tr>

					@endforeach

				</tbody>
			</table>
		<br>
		<hr>
		
        </div><br>
       </div>
</div>
<!-- END PAGE CONTAINER -->

@stop




