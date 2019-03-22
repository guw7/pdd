<!DOCTYPE html>

<html lang="en">
    <head>                        
        <title>Pengawasan Dana Desa</title>            
        
        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" href="{{asset('asset/css/styles.css')}}">
        <!-- EOF CSS INCLUDE -->

    </head>
    <body>        
        
        <!-- APP WRAPPER -->
        <div class="app">           

            <!-- START APP CONTAINER -->
            <div class="app-container">
                <!-- START SIDEBAR -->

                <!-- <div class="app-sidebar app-navigation app-navigation-fixed scroll app-navigation-open-hover dir-left mCustomScrollbar _mCS_1 mCS-autoHide app-navigation-fixed-absolute mCS_no_scrollbar active app-navigation-style-purple" data-type="close-other">
 -->
                <div class="app-sidebar app-navigation scroll  app-navigation-fixed app-navigation-style-purple dir-left app-navigation-open-hover" data-type="close-other">

                    <a href="{{url('/admin/index')}}" class="app-navigation-logo">
                        Pengawasan Dana Desa - 2017
                    </a>
                    
                    <nav>
                        <ul>
                            <li class="title">UTAMA</li>
                            <li><a href="{{url('admin/index')}}"><span class="icon-home"></span> Dashboard</a></li>
                            </ul>

                            <ul>
                                 <li class="title">MAIN</li>  
                                <li><a href="{{url('/kampung/create')}}"><span class="icon-apartment"></span>TAMBAH KAMPUNG</a>
                                </li>
                            </ul>
                            
                            <ul>  
                                <li><a href="{{url('/kegiatan/create')}}"><span class="icon-chart-bars"></span>TAMBAH KEGIATAN</a>
                                </li>
                            </ul>

                            <ul>
                                <li>
                                    <a href="#"><span class="icon-database"></span>Lihat Tabel</a>
                                    <ul>                                
                                        <li><a href="{{url('/user')}}"><span class="icon-user"></span> Tabel User </a></li>
                                        <li><a href="{{url('/kampung')}}"><span class="icon-apartment"></span>Tabel Kampung</a></li>     
                                        <li><a href="{{url('/komentar')}}"><span class="icon-bubble"></span>Tabel Komentar</a></li>           
                                        <li><a href="{{url('/kegiatan')}}"><span class="icon-chart-bars"></span>Tabel Kegiatan</a></li>
                                        
                                    </ul>
                                </li>  
                            </ul>   
                            
                            <!-- <ul>
                                <li class="title">Menu Lain</li>
                                <li>
                                    <a href="#"><span class="icon-leaf"></span> Menu Lain</a>    
                                <ul>
                                    <li>
                                        <a href="#"><span class="icon-rocket"></span> Satu</a>
                                        <ul>                
                                            <li><a href="#"><span class="nav-icon-hexa">S</span> Simple</a></li>
                                            <li><a href="#"><span class="nav-icon-hexa">IC</span> Insde Content</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li>         
                                        <a href="#"><span class="icon-bug"></span> Dua</a>
                                        <ul>
                                            <li><a href="#"><span class="nav-icon-hexa">Ls</span> Left Sidebar</a></li>
                                            <li><a href="#"><span class="nav-icon-hexa">Rs</span> Right Sidebar</a></li>
                                        </ul>
                                    </li> 
                                </ul>
                                </li>
                            </ul> -->

                        <ul>
                            <li class="title"></li>   
                            <li><a href="{{url('/login')}}"><span class="icon-power-switch"></span>Logout</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- END SIDEBAR -->
                
                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    <!-- START APP HEADER -->
                    <div class="app-header active app-header-design-default">
                        <ul class="app-header-buttons">
                            <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                            <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                        </ul>
                        <form class="app-header-search" action="" method="post">        
                            <input type="text" name="keyword" placeholder="Search">
                        </form>    
                    
                        <ul class="app-header-buttons pull-right">
                            <li>
                                <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls">
                                    <img src="{{asset('asset/assets/images/users/user_2.png')}}" alt="G.U.W">
                                    <div class="contact-container">
                                        <a href="#">G.U.W</a>
                                        <span>Administrator</span>
                                    </div>
                                    <div class="contact-controls">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown"><span class="icon-cog"></span></button>                        
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-cog"></span> Settings</a></li> 
                                                <li><a href="#"><span class="icon-envelope"></span> Messages <span class="label label-danger pull-right">+24</span></a></li>
                                                <li><a href="#"><span class="icon-users"></span> Contacts <span class="label label-default pull-right">76</span></a></li>
                                                <li class="divider"></li>
                                                <li><a href="{{url('/login')}}"><span class="icon-exit"></span>Log Out</a></li> 
                                            </ul>
                                        </div>                    
                                    </div>
                                </div>
                            </li>        
                        </ul>
                    </div>
                    <!-- END APP HEADER  -->
                    
                    <!-- START PAGE HEADING -->
                    <div class="app-heading app-heading-bordered app-heading-page">
                        <div class="icon icon-lg">
                            <span class="icon-laptop-phone"></span>
                        </div>
                        <div class="title">
                            <h1>Pengawasan Dana Desa </h1>
                            <p> Open Data Banda Aceh</p>
                        </div> 
                    </div> 
                    <div class="app-heading-container app-heading-bordered bottom">
                        <ul class="breadcrumb">
                            <li><a href="">Application</a></li>                                                     
                            <li class="active">Dashboard</li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADING -->

<!-- =========================================================================== ->                  
                    
                    <!-- START PAGE CONTAINER -->
                    
                             @yield('content')
                     
                    <!-- END PAGE CONTAINER -->

<!-- ============================================================================ -->   
                   
            </div>
            <!-- END APP CONTENT -->
                            
        </div>
        <!-- END APP CONTAINER -->  

<!-- ============================================================================ -->   
        
        <!-- START APP FOOTER -->
        
        <!-- END APP FOOTER -->

    </div>  
    <!-- END APP WRAPPER -->      

<!-- ======================================================================================== -->     
        
        <!-- IMPORTANT SCRIPTS -->
        <script type="text/javascript" src="{{asset('asset/js/vendor/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/jquery/jquery-migrate.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/bootstrap/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/moment/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        <!-- END IMPORTANT SCRIPTS -->
        <!-- THIS PAGE SCRIPTS -->
        <script type="text/javascript" src="{{asset('asset/js/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
        <!-- END THIS PAGE SCRIPTS -->
        <!-- APP SCRIPTS -->
        <script type="text/javascript" src="{{asset('asset/js/app.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/app_plugins.js')}}"></script>
        <!-- END APP SCRIPTS -->
        
        <!-- THIS PAGE SCRIPTS -->
        <script type="text/javascript" src="{{asset('asset/js/vendor/bootstrap-select/bootstrap-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/select2/select2.full.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/bootstrap-daterange/daterangepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('asset/js/vendor/multiselect/jquery.multi-select.js')}}"></script>
        <!-- END THIS PAGE SCRIPTS -->

    </body>
</html>