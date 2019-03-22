@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h5>Tabel kampung</h5>
          </div>
 				 <a href="{{route('kampung.create')}}">
					<input type="button" class="btn btn-success col-md-2 pull-right" value="Tambah" /></a>
      </div>
      
      <!-- END HEADING --> 

      <div class="block-content">
          	
          	@if(Session::has('SUCCESS'))
					{{Session::get('SUCCESS')}}
			@endif
			
			<table class="table table-striped table-bordered datatable-extended">
			
				<thead>
				<tr>
						<th style="text-align:center">Nama Kampung</th>	
						<th style="text-align:center">Nama Geuchik</th>	
						<th style="text-align: center;">action</th>
				</tr>	
				</thead>

				<tbody>

					@foreach ($kampungs as $kampung)

					<tr>
						<td>{{$kampung->nama_kampung}}</td>
						<td>{{$kampung->nm_gecik}}</td>
						<td>

						<form action="{{route('kampung.destroy', $kampung->id)}}" method="POST">

							<input type="hidden" name="_token" value="{{csrf_token() }}">
							<input type="hidden" name="_method" value="delete">

							<center>
							<a href="{{route('kampung.edit', $kampung->id)}}"> 
							<input type="button" class="btn btn-info" value="Edit" ></a>

							<input type="submit" class="btn btn-danger" name="delete" value="Delete" onclick="return confirm('Anda yakin ingin menghapus data ?');" />
							</center>
						</form>
							
						</td>
					</tr>

					@endforeach

				</tbody>
				</div>
			</table>
		<br>
		<hr>
		
        </div><br>
       </div>
</div>
<!-- END PAGE CONTAINER -->		
				 
	@stop