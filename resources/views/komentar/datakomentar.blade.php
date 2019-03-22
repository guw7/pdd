@extends('home')
@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h5>Tabel User</h5>
          </div>
         		 <a href="{{route('komentar.create')}}">
					<input type="button" class="btn btn-success col-md-2 pull-right" value="Tambah" /></a>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">

          	@if(Session::has('SUCCESS'))
					{{Session::get('SUCCESS')}}
			@endif
		<div>
			<table class="table table-striped table-bordered datatable-extended ">

				<thead>
				<tr>
						<th style="text-align:center">Nama User</th>
						<th style="text-align:center">Nama Kegiatan</th>
						<th style="text-align:center">Komentar</th>
						<th style="text-align:center">Foto</th>
						<th style="text-align:center">Like</th>
					<!-- 	<th style="text-align:center">tampil</th> -->
						<th style="text-align:center">action</th>
				</tr>	
				</thead>

				<tbody>

					@foreach ($komentars as $komentar)

					<tr align="center">
						<td>{{$komentar->nama}}</td>
						<td>{{$komentar->nama_kegiatan}}</td>
						<td>{{$komentar->komen}}</td>
						<td>{{$komentar->foto}}</td>
						<td>{{$komentar->j_like}}</td>
						
					<!--  <td>
							<?php
								// if($komentar->tampil=='0'){ ?>
								
							<!-- 	<form action="{{URL::route('tampil', $komentar->id)}}" method="POST">
								{{csrf_field() }}
								<center>
								<input type="submit" class="btn btn-success" value="Tampilkan" >
								</center>
								</form> -->

						<!-- 	<?php
								//}else if ($komentar->tampil=='1') { ?>
								<form action="{{URL::route('hilangkan', $komentar->id)}}" method="POST">
								{{csrf_field() }}
								<center>
								<input type="submit" class="btn btn-danger" value="Hilangkan">
								</center>
								</form>

							<?php 
							//} ?>

						</td>  --> 

						<td nowrap>
						<form action="{{route('komentar.destroy', $komentar->id)}}" method="POST">
						<center>
							
							<input type="hidden" name="_token" value="{{csrf_token() }}">
							<input type="hidden" name="_method" value="delete">

							<!-- <a href="{{route('komentar.edit',$komentar->id)}}"> 
							<input type="button" class="btn btn-info"  value="Edit" ></a> -->
							<input type="submit" name="delete" class="btn btn-danger" value="Delete" onclick="return confirm('Anda yakin ingin menghapus data ?');" />

						</center>
						</form>
							
						</td>
					</tr>

					@endforeach

				</tbody>
			</table>
			</div>
		<br>
		<hr>
		
        </div><br>
       </div>
</div>
<!-- END PAGE CONTAINER -->
				 
	@stop




