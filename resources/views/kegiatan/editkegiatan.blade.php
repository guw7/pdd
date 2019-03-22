@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h1>Form Edit Kegiatan</h1>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">

          <h2>Silahkan Edit Kegiatan :</h2>


        @if (count($errors) > 0)
           
          {{ $errors->first('nama_kegiatan') }}<br>
                  {{ $errors->first('foto') }}<br>
                  {{ $errors->first('alamat') }}<br>
                  {{ $errors->first('kontak_person') }}<br>
                  {{ $errors->first('email') }}<br>
                  {{ $errors->first('keterangan') }}<br>
                  {{ $errors->first('mulai_kegiatan') }}<br>
                  {{ $errors->first('berakhir_kegiatan') }}<br>
                  {{ $errors->first('penanggung_jawab') }}<br>
                  {{ $errors->first('jumlah_anggaran') }}<br>
                  {{ $errors->first('thn_anggaran') }}<br>
                  {{ $errors->first('id_kampung') }}<br>
          
        @endif 


        <form action="{{route('kegiatan.update', $kegiatan->id)}}" method="POST">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="_method" value="PATCH">
          
            <div class="form-group">
              <label class="col-md-2 control-label">Nama Kegiatan</label>
              <div class="col-md-6">
                  <input type="text" name="nama_kegiatan" class="form-control" value="{{$kegiatan->nama_kegiatan}}">
              </div>
            </div>

       <div class="form-group">
        <label class="col-md-2 control-label">Foto</label>
        <div class="col-md-6">
          <input type="file" name="foto"> {{$kegiatan->foto}}
        </div>
      </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Alamat</label>
              <div class="col-md-6">
                 <input type="text" name="alamat" class="form-control" value="{{$kegiatan->alamat}}">
              </div>
            </div>

            
            <div class="form-group">
              <label class="col-md-2 control-label">Kontak Person</label>
              <div class="col-md-6">
                 <input type="text" name="kontak_person" class="form-control" value="{{$kegiatan->kontak_person}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Email</label>
              <div class="col-md-6">
                 <input type="email" name="email" class="form-control" value="{{$kegiatan->email}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Keterangan</label>
              <div class="col-md-6">
                 <input type="text" name="keterangan" class="form-control" value="{{$kegiatan->keterangan}}">
              </div>
            </div>

      <div class="form-group">
        <label class="col-md-2 control-label">Mulai Kegiatan</label>
        <div class="col-md-6">
          <div class="input-group bs-datepicker">
            <input type="text" name="mulai_kegiatan"  class="form-control" value="{{$kegiatan->mulai_kegiatan}}">
            <span class="input-group-addon">
              <span class="icon-calendar-full"></span>
            </span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-2 control-label">Berakhir_kegiatan</label>
        <div class="col-md-6">
          <div class="input-group bs-datepicker">
            <input type="text" name="berakhir_kegiatan"  class="form-control" value="{{$kegiatan->berakhir_kegiatan}}">
            <span class="input-group-addon">
              <span class="icon-calendar-full"></span>
            </span>
          </div>
        </div>
      </div>
            
            <div class="form-group">
              <label class="col-md-2 control-label">Penanggung Jawab</label>
              <div class="col-md-6">
                <input type="text" name="penanggung_jawab" class="form-control" value="{{$kegiatan->penanggung_jawab}}">
              </div>
            </div>

      <div class="form-group">
        <label class="col-md-2 control-label">Jumlah Anggaran</label>
        <div class="col-md-6">
          <div class="input-group">
            <input type="number" name="jumlah_anggaran" class="form-control" value="{{$kegiatan->jumlah_anggaran}}">
            <span class="input-group-addon">
              <span class="nav-icon-hexa">Rp</span>
            </span>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-2 control-label">Tahun Anggaran</label>
        <div class="col-md-6">
          <select name="thn_anggaran" class="bs-select">
            <option>{{$kegiatan->thn_anggaran}}</option>
          </select>
        </div>
      </div>

      <div class="form-group">
                      <label class="col-md-2 control-label">Nama Kampung   :</label>
      <div class="col-md-6" >
                      <select name="id_kampung" class="form-control" data-live-search="true" required>
                      @foreach ($ambilkampungs as $ambil)
                    <option value="{{$kegiatan->id_kampung}}" hidden>{{$ambil->nama_kampung}}</option>
                    @endforeach
                    @foreach ($kampungs as $kampung)
                        <option value="{{$kampung->id}}">{{$kampung->nama_kampung}}</option>
                    @endforeach
                  </select>
             </div>
        </div>    
              
            <center>
              <input type="submit" class="btn btn-info" value="Edit Data">
              <a href="{{route('kegiatan.index')}}">
              <input type="button" class="btn btn-danger" value="Batal "></a>
            </center>
      
        </form>

      </div>
   </div>
</div>  
<!-- END PAGE CONTAINER -->
    
@endsection