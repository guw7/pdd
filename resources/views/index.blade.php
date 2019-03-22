@extends('home')

@section('content')

<div class="container">
  
  <div class="row">

        <div class="col-md-3">
            
            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                <li>
                    <!-- START WIDGET -->
                    <div class="app-widget-tile app-widget-highlight">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="icon icon-lg">
                                    <span class="icon-pie-chart"></span>
                                </div>
                            </div>
                            <div class="col-sm-8">                                                    
                                <div class="line">
                                    <div class="title pull-right"><span class="label label-danger label-bordered">KEGIATAN</span></div>       
                                </div>                                        
                                <div class="intval text-left">{{$kegiatan}}</div>                                        
                                <div class="line">
                                    <div class="subtitle"><a href="{{url('/kegiatan')}}">Total Kegiatan</a></div>
                                </div>
                            </div>
                        </div>
                    </div>                                                                 
                    <!-- END WIDGET -->
                </li>
            </ul>
            
        </div>
       
        <div class="col-md-3">
            
            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                <li>
                    <!-- START WIDGET -->
                     <div class="app-widget-tile app-widget-highlight">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="icon icon-lg">
                                    <span class="icon-home"></span>
                                </div>
                            </div>
                            <div class="col-sm-8">                                                    
                                <div class="line">
                                    <div class="title pull-right"><span class="label label-warning label-bordered">KAMPUNG</span></div>       
                                </div>                                        
                                <div class="intval text-left">{{$kampung}}</div>                                        
                                <div class="line">
                                    <div class="subtitle"><a href="{{url('/kampung')}}">Total Kampung</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET -->
                </li>
        </div>

        <div class="col-md-3">
            
            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                <li>                                        
                    <!-- START WIDGET -->
                    <div class="app-widget-tile app-widget-highlight">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="icon icon-lg">
                                    <span class="icon-users"></span>
                                </div>
                            </div>
                            <div class="col-sm-8">                                                    
                                <div class="line">
                                     <div class="title pull-right"><span class="label label-success label-bordered">USER</span></div> 
                                </div>                                        
                                <div class="intval text-left">{{$user}}</div>                                        
                                <div class="line">
                                    <div class="subtitle"><a href="{{url('/user')}}">Total Users</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET -->                                        
                </li>
            </ul>
            
        </div>
        <div class="col-md-3">
            
            <ul class="app-feature-gallery app-feature-gallery-noshadow margin-bottom-0">
                
                <li>                                        
                    <!-- START WIDGET -->
                    <div class="app-widget-tile app-widget-highlight">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="icon icon-lg">
                                    <span class="icon-bubble"></span>
                                </div>
                            </div>
                            <div class="col-sm-8">                                                    
                                <div class="line">
                                     <div class="title pull-right"><span class="label label-info label-bordered">KOMENTAR</span></div> 
                                </div>                                        
                                <div class="intval text-left">{{$komentar}}</div>                                        
                                <div class="line">
                                    <div class="subtitle"><a href="#">Total Komentar</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END WIDGET -->     
                </ul>
            </div>
       </div>

        <!-- START BLOCk -->
                        <div class="block">
                            
                            <!-- START PAGE HEADING -->
                            <div class="app-heading app-heading-small">                                
                                <div class="title">
                                    <center><font face="Calibri" style="bold" size="5" >PENGAWASAN DANA DESA</font></center>
                                </div>                                
                            </div>
                            <!-- END PAGE HEADING -->
                            
                            <div class="row">
                                <div class="col-md-10">                                    
                                    <h5>Selamat datang ADMINISTRATOR</h5>
                                    <p>Web ini hanya dapat dikelola oleh seorang administrator, dimana administrator akan mengelola data pengwasan dana desa.</p>
                                </div>
                                                                
                            </div>
                        </div>
                        <!-- END BLOCk -->

</div>
<!-- END PAGE CONTAINER -->
				 
	@stop




