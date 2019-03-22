@extends('home')

@section('content')

<div class="container">
  
  <div class="block block-condensed">
      <!-- START HEADING -->
      <div class="app-heading app-heading-small">
          <div class="title">
              <h1>Form Tambah Kegiatan</h1>
          </div>
      </div>
      <!-- END HEADING --> 

      <div class="block-content">
          <h2>Silahkan Tambah Kegiatan :</h2>

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
              {{ $errors->first('tampil') }}<br>
              {{ $errors->first('J_like') }}<br>
              {{ $errors->first('J_unlike') }}<br>
              {{ $errors->first('J_view') }}<br>
              {{ $errors->first('J_share') }}<br>
              {{ $errors->first('J_rate') }}<br>
              
            @endif 

<div>

    <form action="{{route('kegiatan.store')}}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{csrf_token() }}">

        <div class="form-group">
            <label class="col-md-2 control-label">Nama Kegiatan</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="nama_kegiatan" placeholder="Nama Kegiatan">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Foto</label>
            <div class="col-md-6">
                <input type="file" name="foto">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Alamat</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="alamat" placeholder="Alamat">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Kontak Person</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="kontak_person" placeholder="Kontak Person">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Email</label>
            <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="Email Anda">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Keterangan</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
            </div>
        </div>

    
    <div class="form-group">
      <label class="col-md-2 control-label">Mulai Kegiatan</label>
      <div class="col-md-6">
        <div class="input-group bs-datepicker">
          <input type="text" name="mulai_kegiatan"  class="form-control">
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
          <input type="text" name="berakhir_kegiatan"  class="form-control">
          <span class="input-group-addon">
            <span class="icon-calendar-full"></span>
          </span>
        </div>
      </div>
    </div>
       
        <div class="form-group">
            <label class="col-md-2 control-label">Penanggung Jawab</label>
            <div class="col-md-6">
               <input type="text" class="form-control" name="penanggung_jawab" placeholder="Penanggung Jawab ">
            </div>
        </div> 
        
    
    <div class="form-group">
      <label class="col-md-2 control-label">Jumlah Anggaran</label>
      <div class="col-md-6">
        <div class="input-group">
          <input type="number" name="jumlah_anggaran" class="form-control">
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
         
          <option>2016</option>
          <option>2017</option>    
          <option>2018</option>
          <option>2019</option>
          <option>2020</option>
          <option>2021</option>
          <option>2022</option>
          <option>2023</option>
          <option>2024</option>
          <option>2025</option>
          <option>2026</option>
          <option>2027</option>
          <option>2028</option>
          <option>2029</option>
          <option>2030</option>
          
        </select>
      </div>
    </div>
    
      
     <div class="form-group">
                      <label class="col-md-2 control-label">Nama Kampung   :</label>
            <div class="col-md-6" >
                      <select name="id_kampung" class="form-control" data-live-search="true" required>
                    <option value="" hidden>Pilih Kampung</option>
                    @foreach ($kampungs as $kampung)
                        <option value="{{$kampung->id}}">{{$kampung->nama_kampung}}</option>
                    @endforeach
                  </select>
            </div>
        </div>  
      
        <center>
          <input type="submit" class="btn btn-info" value="Tambah">
          <a href="{{route('kegiatan.index')}}">
          <input type="button" class="btn btn-danger" value="Batal"></a>
        </center>
  
    </form>
    </div>
       
          </div>
   </div>
</div>
<!-- END PAGE CONTAINER -->

    

@endsection