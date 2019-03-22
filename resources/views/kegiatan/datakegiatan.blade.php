@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h5>DATA KEGIATAN</h5>
          </div>
         		 <a href="{{route('kegiatan.create')}}">
					<input type="button" class="btn btn-success col-md-2 pull-right" value="Tambah" /></a>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">

          	@if(Session::has('SUCCESS'))
					{{Session::get('SUCCESS')}}
			@endif
		<div style="overflow: auto">
			<table class="table table-striped table-bordered datatable-extended ">

				<thead>
				<tr>
						<th style="text-align:center">Nama Kegiatan</th>
						<th style="text-align:center">Foto</th>
						<th style="text-align:center">Alamat</th>
						<th style="text-align:center">Kontak Person</th>	
						<th style="text-align:center">Email</th>
						<th style="text-align:center">Keterangan</th>
						<th style="text-align:center">Mulai Kegiatan</th>
						<th style="text-align:center">Berakhir Kegiatan</th>
						<th style="text-align:center">Penanggung Jawab</th>
						<th style="text-align:center">Jumlah Anggaran</th>
						<th style="text-align:center">Tahun Anggaran</th>
						<th style="text-align:center">Nama Kampung</th>
						<th style="text-align:center">Like</th>
						<th style="text-align:center">Unlike</th>
						<th style="text-align:center">View</th>
						<th style="text-align:center">tampil</th>
						<th style="text-align:center">action</th>
				</tr>	
				</thead>

				<tbody>

					@foreach ($kegiatans as $kegiatan)

					<tr>
						<td>{{$kegiatan->nama_kegiatan}}</td>
						<td>{{$kegiatan->foto}}</td>
						<td>{{$kegiatan->alamat}}</td>
						<td>{{$kegiatan->kontak_person}}</td>
						<td>{{$kegiatan->email}}</td>
						<td>{{$kegiatan->keterangan}}</td>
						<td>{{$kegiatan->mulai_kegiatan}}</td>
						<td>{{$kegiatan->berakhir_kegiatan}}</td>
						<td>{{$kegiatan->penanggung_jawab}}</td>
						<td>{{$kegiatan->jumlah_anggaran}}</td>
						<td>{{$kegiatan->thn_anggaran}}</td>
						<td>{{$kegiatan->nama_kampung}}</td>
						<td>{{$kegiatan->j_like}}</td>
						<td>{{$kegiatan->j_unlike}}</td>
						<td>{{$kegiatan->j_view}}</td>
						
						<td>

							<?php

								if($kegiatan->tampil=='0'){ ?>
								
								<form action="{{URL::route('tampil', $kegiatan->id)}}" method="POST">
								{{csrf_field() }}
								<input type="submit" class="btn btn-success" value="Tampilkan" >
								</form>

							<?php
								}else if ($kegiatan->tampil=='1') { ?>
								<form action="{{URL::route('hilangkan', $kegiatan->id)}}" method="POST">
								{{csrf_field() }}
								<input type="submit" class="btn btn-danger" value="Hilangkan">
								</form>

							<?php } ?>

						</td>

						<td nowrap>
						<form action="{{route('kegiatan.destroy', $kegiatan->id)}}" method="POST">
						<center>
							
							<input type="hidden" name="_token" value="{{csrf_token() }}">
							<input type="hidden" name="_method" value="delete">

							<a href="{{route('kegiatan.edit',$kegiatan->id)}}"> 
							<input type="button" class="btn btn-info"  value="Edit" ></a>
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




