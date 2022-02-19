
<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
        .fileUpload {
            position: relative;
            overflow: hidden;
            margin: 10px;
        }
        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
         </style> 
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?php echo $title;?></title>
        <!-- Favicon-->
        <link rel="icon" href="<?php echo base_url(); ?>adminBSB/images/Politeknik.png" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="<?php echo base_url(); ?>adminBSB/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?php echo base_url(); ?>adminBSB/plugins/node-waves/waves.css" rel="stylesheet" />
        <!-- Sweetalert Css -->
        <link href="<?php echo base_url(); ?>adminBSB/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- JQuery DataTable Css -->
        <link href="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">


        <link href="<?php echo base_url(); ?>adminBSB/plugins/morrisjs/morris.css" rel="stylesheet" />
        <!-- Animation Css -->
        <link href="<?php echo base_url(); ?>adminBSB/plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Bootstrap Select Css -->
        <!-- <link href="<?php //echo base_url(); ?>adminBSB/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" /> -->

        <!-- Bootstrap Material Datetime Picker Css -->
        <link href="<?php echo base_url(); ?>adminBSB/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>adminBSB/plugins/select2/dist/css/select2.min.css"/>


        <!-- Custom Css -->
        <link href="<?php echo base_url(); ?>adminBSB/css/style.css" rel="stylesheet">


        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="<?php echo base_url(); ?>adminBSB/css/themes/all-themes.css" rel="stylesheet" />

          <!-- Jquery Core Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/select2/dist/js/select2.min.js"></script>

        <!-- Autosize Plugin Js -->
         <script src="<?php echo base_url(); ?>adminBSB/plugins/autosize/autosize.js"></script>
        <!-- Moment Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/momentjs/moment.js"></script>
        <!-- Bootstrap Material Datetime Picker Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <!-- Input Mask Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
        
        <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key=AIzaSyB8DAX3Thn7-UzkMPUPDzbc_EDzddIdTrY"></script>  -->
        <!--  <script async defer src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=id&key=AIzaSyB8DAX3Thn7-UzkMPUPDzbc_EDzddIdTrY&callback=initMap"></script>  -->

    </head>

    <body class="theme-light-blue ls-closed">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->

        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a> -->
                    <a href="javascript:void(0);" class="bars"></a>
                    <!-- <a class="navbar-brand" href="<?php echo base_url(); ?>adminBSB/index.html"><i class="Log"> <img src="<?php echo base_url()?>/adminBSB/images/Politeknik.png" width="25px" height="25px"></i> -->
                    <a class="navbar-brand" href="#"><i class="Log"> <img src="<?php echo base_url()?>/adminBSB/images/Politeknik.png" width="25px" height="25px"></i>
                      <b>   PRAKERIN</b>
                    </a>

                    
                    
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- #END# Notifications -->
                        <!-- Tasks -->

                        <!-- #END# Tasks -->
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="image-rounded">
                        <?php
                                if ($this->session->userdata('SESS_LEVEL')== "Administrator" or $this->session->userdata('SESS_LEVEL')== "Admin" or $this->session->userdata('SESS_LEVEL')== "kajur") {

                                        $gambar;
                                        if (!$this->session->userdata('SESS_GAMBAR')=="") {
                                            $gambar=$this->session->userdata('SESS_GAMBAR');
                                        }else{
                                            $gambar="Profile_kosong.png";
                                        }
                                        
                                 ?>
                                 <img src="<?php echo base_url(); ?>adminBSB/images/user/<?= $gambar;?>" width="48" height="48" alt="user-img" class="img-rounded"/>
                                <?php
                                    }else{

                                        $gambar;
                                        if (!$this->session->userdata('SESS_GAMBAR')=="") {
                                            $gambar=$this->session->userdata('SESS_GAMBAR');
                                        }else{
                                            $gambar="Profile_kosong.png";
                                        }
                                  ?>
                                 <img src="<?php echo base_url(); ?>adminBSB/images/user/Mahasiswa/<?= $gambar;?>" width="48" height="48" alt="user-img" class="img-rounded"/>
                                <?php
                                    }
                                ?>
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('SESS_NAME');?></div>
                        <div class="email"><?= $this->session->userdata('SESS_EMAIL');?></div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <?php
                                    if ($this->session->userdata('SESS_LEVEL')== "Administrator" or $this->session->userdata('SESS_LEVEL')== "Admin" or  $this->session->userdata('SESS_LEVEL')== "kajur") {
                                        
                                 ?>
                                 <li><a href="<?php echo base_url(); ?>profil/profil_admin/<?= $this->session->userdata('SESS_USERNAME');?>"><i class="material-icons">person</i>Profile</a></li>
                                <?php
                                    }else{

                                  ?> 
                                  <li><a href="<?php echo base_url(); ?>profil/profil_mahasiswa/<?= $this->session->userdata('SESS_USERNAME');?>"><i class="material-icons">person</i>Profile</a></li>
                                <?php
                                    }
                                ?>
                                <li role="seperator" class="divider"></li>
                                <li><a class='logout' href="<?php echo base_url()?>/Login/logout"><i class="material-icons">input</i>Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                    <?php
                        if ($this->session->userdata('SESS_LEVEL')== "Administrator") {
                                        
                                 ?>
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="<?php if($this->uri->segment(1)=="dashboard" or $this->uri->segment(1)=="profil"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>dashboard">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="jurusan" or $this->uri->segment(1)=="bidang"  or $this->uri->segment(1)=="kategori"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons"> perm_identity</i>
                                <span>Master</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(1)=="jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>jurusan/index">
                                        <i class="material-icons">assignment_ind</i>
                                        <span>Jurusan</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(1)=="bidang"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>bidang/index">
                                        <i class="material-icons">build</i>
                                        <span>Bidang</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(1)=="kategori"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>kategori/index">
                                        <i class="material-icons">assignment</i>
                                        <span>Kategori</span>
                                    </a>
                                </li>
                            </ul>
                        </li> 
                        <li class="<?php if($this->uri->segment(1)=="user" or $this->uri->segment(1)=="mahasiswa"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons"> people</i>
                                <span>User</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(1)=="user"){echo " active";}?>">
                                <a href="<?php echo base_url(); ?>user/index">
                                    <i class="material-icons">account_box</i>
                                    <span>Admin</span>
                                </a>
                            </li>
                            <li class="<?php if($this->uri->segment(1)=="mahasiswa"){echo " active";}?>">
                                <a href="<?php echo base_url(); ?>mahasiswa/index">
                                    <i class="material-icons">supervisor_account</i>
                                    <span>Mahasiswa</span>
                                </a>
                            </li> 
                            </ul>
                        </li> 
                         
                       <li class="<?php if($this->uri->segment(1)=="industri"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>industri/index" class="waves-effect waves-block">
                                <i class="material-icons">account_balance</i>
                                <span>Industri</span>
                            </a>
                        </li>                       
                        <li class="<?php if($this->uri->segment(1)=="pengajuan"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>pengajuan/index">
                                <i class="material-icons">featured_play_list</i>
                                <span>Pengajuan</span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="prakerin"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>prakerin/index">
                                <i class="material-icons">book</i>
                                <span>Prakerin</span>
                            </a>
                        </li>
                        </li><li class="<?php if($this->uri->segment(1)=="jurnal"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>jurnal/index">
                                <i class="material-icons">branding_watermark</i>
                                <span>Jurnal</span>
                            </a>
                        </li>

                        <li class="header">LAPORAN</li>

                        <li class="<?php if($this->uri->segment(2)=="laporan_peta" or $this->uri->segment(2)=="laporan_peta_periode" or $this->uri->segment(2)=="laporan_peta_perjurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-light-green">map</i>
                                <span>Peta</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_peta"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_peta" class="waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Peta</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_peta_periode"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_peta_periode" class="waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Peta Perjurusan Perperiode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_peta_perjurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_peta_perjurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Peta Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                         <li class="<?php if($this->uri->segment(2)=="laporan_grafik" or $this->uri->segment(2)=="laporan_grafik_periode" or $this->uri->segment(2)=="laporan_grafik_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-red">graphic_eq</i>
                                <span>Grafik</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_grafik"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_grafik" class="waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Grafik</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_grafik_periode"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_grafik_periode" class="waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Grafik Perjurusan Perperiode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_grafik_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_grafik_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Grafik Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan" or $this->uri->segment(2)=="laporan_pengajuan_tahun" or $this->uri->segment(2)=="laporan_pengajuan_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-light-blue">donut_large</i>
                                <span>Data Pengajuan</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_pengajuan" class="waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Pengajuan</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_pengajuan_tahun" class="waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Pengajuan Perjurusan Perperiode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_pengajuan_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Pengajuan Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                         <li class="<?php if($this->uri->segment(2)=="laporan_ditolak" or $this->uri->segment(2)=="laporan_ditolak_tahun" or $this->uri->segment(2)=="laporan_ditolak_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-red">donut_large</i>
                                <span>Data Pengajuan Tidak Diterima</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_ditolak"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_ditolak" class="waves-effect waves-block">
                                        <i class="material-icons col-light-blue">donut_large</i>
                                        <span>Tidak Diterima </span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_ditolak_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_ditolak_tahun" class="waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Tidak Diterima Perjurusan Perperiode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_ditolak_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_ditolak_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Tidak Diterima Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="<?php if($this->uri->segment(2)=="laporan_diterima" or $this->uri->segment(2)=="laporan_diterima_tahun" or $this->uri->segment(2)=="laporan_diterima_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-green">donut_large</i>
                                <span>Data Pengajuan Diterima</span>
                            </a>
                             <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_diterima"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_diterima" class="waves-effect waves-block">
                                        <i class="material-icons col-light-blue">donut_large</i>
                                        <span>Diterima</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_diterima_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_diterima_tahun" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Diterima Perjurusan Periode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_diterima_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_diterima_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Diterima Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php if($this->uri->segment(2)=="laporan_prakerin" or $this->uri->segment(2)=="laporan_prakerin_tahun" or $this->uri->segment(2)=="laporan_prakerin_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-amber">donut_large</i>
                                <span>Data Prakerin</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_prakerin"){echo " active";}?>">

                                    <a href="<?php echo base_url(); ?>laporan/laporan_prakerin" class=" waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Tempat Prakerin</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_prakerin_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_prakerin_tahun" class=" waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Tempat Prakerin Perjurusan Perperoide</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_prakerin_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_prakerin_jurusan" class=" waves-effect waves-block">
                                        <i class="material-icons col-light-blue">donut_large</i>
                                        <span>Prakerin Mahasiswa Perjurusan</span>
                                    </a>
                                </li>  
                            </ul>
                        </li>
                        <?php
                        }else if ($this->session->userdata('SESS_LEVEL')== "Admin") {

                        ?>
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="<?php if($this->uri->segment(1)=="dashboard" or $this->uri->segment(1)=="profil"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>dashboard">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="jurusan" or $this->uri->segment(1)=="bidang"  or $this->uri->segment(1)=="kategori"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons"> perm_identity</i>
                                <span>Master</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(1)=="jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>jurusan/index">
                                        <i class="material-icons">assignment_ind</i>
                                        <span>Jurusan</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(1)=="bidang"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>bidang/index">
                                        <i class="material-icons">build</i>
                                        <span>Bidang</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(1)=="kategori"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>kategori/index">
                                        <i class="material-icons">assignment</i>
                                        <span>Kategori</span>
                                    </a>
                                </li>
                            </ul>
                        </li> 
                        <li class="<?php if($this->uri->segment(1)=="mahasiswa"){echo " active";}?>">
                                <a href="<?php echo base_url(); ?>mahasiswa/index">
                                    <i class="material-icons">supervisor_account</i>
                                    <span>Mahasiswa</span>
                                </a>
                        </li> 
                         
                       <li class="<?php if($this->uri->segment(1)=="industri"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>industri/index" class="waves-effect waves-block">
                                <i class="material-icons">account_balance</i>
                                <span>Industri</span>
                            </a>
                        </li>                       
                        <li class="<?php if($this->uri->segment(1)=="pengajuan"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>pengajuan/index">
                                <i class="material-icons">featured_play_list</i>
                                <span>Pengajuan</span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="prakerin"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>prakerin/index">
                                <i class="material-icons">book</i>
                                <span>Prakerin</span>
                            </a>
                        </li>
                        </li><li class="<?php if($this->uri->segment(1)=="jurnal"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>jurnal/index">
                                <i class="material-icons">branding_watermark</i>
                                <span>Jurnal</span>
                            </a>
                        </li>

                        <li class="header">LAPORAN</li>

                        

                        <li class="<?php if($this->uri->segment(2)=="laporan_grafik" or $this->uri->segment(2)=="laporan_grafik_periode" or $this->uri->segment(2)=="laporan_grafik_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-red">graphic_eq</i>
                                <span>Grafik</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_grafik"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_grafik" class="waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Grafik</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_grafik_periode"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_grafik_periode" class="waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Grafik Perjurusan Perperiode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_grafik_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_grafik_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Grafik Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan" or $this->uri->segment(2)=="laporan_pengajuan_tahun" or $this->uri->segment(2)=="laporan_pengajuan_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-light-blue">donut_large</i>
                                <span>Data Pengajuan</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_pengajuan" class="waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Pengajuan</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_pengajuan_tahun" class="waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Pengajuan Perjurusan Perperiode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_pengajuan_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_pengajuan_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Pengajuan Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                         <li class="<?php if($this->uri->segment(2)=="laporan_ditolak" or $this->uri->segment(2)=="laporan_ditolak_tahun" or $this->uri->segment(2)=="laporan_ditolak_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-red">donut_large</i>
                                <span>Data Pengajuan Tidak Diterima</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_ditolak"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_ditolak" class="waves-effect waves-block">
                                        <i class="material-icons col-light-blue">donut_large</i>
                                        <span>Tidak Diterima </span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_ditolak_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_ditolak_tahun" class="waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Tidak Diterima Perjurusan Perperiode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_ditolak_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_ditolak_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Tidak Diterima Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="<?php if($this->uri->segment(2)=="laporan_diterima" or $this->uri->segment(2)=="laporan_diterima_tahun" or $this->uri->segment(2)=="laporan_diterima_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-green">donut_large</i>
                                <span>Data Pengajuan Diterima</span>
                            </a>
                             <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_diterima"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_diterima" class="waves-effect waves-block">
                                        <i class="material-icons col-light-blue">donut_large</i>
                                        <span>Diterima</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_diterima_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_diterima_tahun" class="waves-effect waves-block">
                                        <i class="material-icons col-amber">donut_large</i>
                                        <span>Diterima Perjurusan Periode</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_diterima_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_diterima_jurusan" class="waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Diterima Perjurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php if($this->uri->segment(2)=="laporan_prakerin" or $this->uri->segment(2)=="laporan_prakerin_tahun" or $this->uri->segment(2)=="laporan_prakerin_jurusan"){echo " active";}?>">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons col-amber">donut_large</i>
                                <span>Data Prakerin</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="<?php if($this->uri->segment(2)=="laporan_prakerin"){echo " active";}?>">

                                    <a href="<?php echo base_url(); ?>laporan/laporan_prakerin" class=" waves-effect waves-block">
                                        <i class="material-icons col-red">donut_large</i>
                                        <span>Tempat Prakerin</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_prakerin_tahun"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_prakerin_tahun" class=" waves-effect waves-block">
                                        <i class="material-icons col-light-green">donut_large</i>
                                        <span>Tempat Prakerin Perjurusan Perperoide</span>
                                    </a>
                                </li>
                                <li class="<?php if($this->uri->segment(2)=="laporan_prakerin_jurusan"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>laporan/laporan_prakerin_jurusan" class=" waves-effect waves-block">
                                        <i class="material-icons col-light-blue">donut_large</i>
                                        <span>Prakerin Mahasiswa Perjurusan</span>
                                    </a>
                                </li>  
                            </ul>
                        </li>
                        <?php
                        }else if ($this->session->userdata('SESS_LEVEL')== "kajur") {
                                        
                                 ?>
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="<?php if($this->uri->segment(1)=="dashboard" or $this->uri->segment(1)=="profil"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>dashboard/index_kajur">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>                       
                        <li class="<?php if($this->uri->segment(1)=="pengajuan"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>pengajuan/index_kajur">
                                <i class="material-icons">featured_play_list</i>
                                <span>Pengajuan</span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="prakerin"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>prakerin/index_kajur">
                                <i class="material-icons">book</i>
                                <span>Prakerin</span>
                            </a>
                        </li>
                        </li><li class="<?php if($this->uri->segment(1)=="jurnal"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>jurnal/index_kajur">
                                <i class="material-icons">branding_watermark</i>
                                <span>Jurnal</span>
                            </a>
                        </li>
                       <?php
                            }else{

                         ?> 
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="<?php if($this->uri->segment(1)=="dashboard" or $this->uri->segment(1)=="profil"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>dashboard/index_mahasiswa">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="industri"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>industri/index_mahasiswa" class="waves-effect waves-block">
                                <i class="material-icons">account_balance</i>
                                <span>Industri</span>
                            </a>
                        </li>                       
                        <li class="<?php if($this->uri->segment(1)=="pengajuan"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>pengajuan/index_mahasiswa">
                                <i class="material-icons">featured_play_list</i>
                                <span>Pengajuan</span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="bidang"){echo " active";}?>">
                                    <a href="<?php echo base_url(); ?>bidang/index_mahasiswa">
                                        <i class="material-icons">build</i>
                                        <span>Bidang</span>
                                    </a>
                        </li>                        
                        <li class="<?php if($this->uri->segment(1)=="prakerin"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>prakerin/index_mahasiswa">
                                <i class="material-icons">book</i>
                                <span>Prakerin</span>
                            </a>
                        </li>
                        </li><li class="<?php if($this->uri->segment(1)=="jurnal"){echo " active";}?>">
                            <a href="<?php echo base_url(); ?>jurnal/index_mahasiswa">
                                <i class="material-icons">branding_watermark</i>
                                <span>Jurnal</span>
                            </a>
                        </li>

                                <?php
                                    }
                                ?>
                        
                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                <div class="copyright">
                    <img  alt="" src="<?php echo base_url()?>/adminBSB/images/Politeknik.png" width="15px" height="15px" >
                    Sistem Informasi Pemetaan Prakerin 2017 
                    </div>
                    <div class="version">
                        <b>Muhamad Ramlan Ramdani </b>
                    </div>
                </div>
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
           
        </section>

        <section class="content">
            <?php
            echo $contents;
            ?>
        </section>

      

        <!-- Bootstrap Core Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/bootstrap/js/bootstrap.js"></script>

        

        <!-- Select Plugin Js -->
        <!-- <script src="<?php //echo base_url(); ?>adminBSB/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->


        

        <!-- Slimscroll Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Jquery Validation Plugin Css -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-validation/jquery.validate.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/node-waves/waves.js"></script>

         <!-- SweetAlert Plugin Js -->
         <script src="<?php echo base_url(); ?>adminBSB/plugins/sweetalert/sweetalert.min.js"></script>

        <!-- Jquery CountTo Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-countto/jquery.countTo.js"></script>

         <!-- Bootstrap Notify Plugin Js -->
         <script src="<?php echo base_url(); ?>adminBSB/plugins/bootstrap-notify/bootstrap-notify.js"></script>


        <!-- Morris Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/raphael/raphael.min.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/morrisjs/morris.js"></script>

        <!-- ChartJs -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/chartjs/Chart.bundle.js"></script>

        
        <!-- Sparkline Chart Plugin Js -->
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-sparkline/jquery.sparkline.js"></script>

         <!-- Jquery DataTable Plugin Js -->

        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

         

        <!-- Custom Js -->
        <script src="<?php echo base_url(); ?>adminBSB/js/admin.js"></script>
        <!-- <script src="<?php //echo base_url(); ?>adminBSB/js/pages/forms/basic-form-elements.js"></script> -->
        <script src="<?php echo base_url(); ?>adminBSB/js/pages/tables/jquery-datatable.js"></script>
        <script src="<?php echo base_url(); ?>adminBSB/js/pages/ui/dialogs.js"></script>
        <!-- <script src="<?php //echo base_url(); ?>adminBSB/js/pages/forms/advanced-form-elements.js"></script> -->
        <script src="<?php echo base_url(); ?>adminBSB/js/pages/forms/form-validation.js"></script>

       
        


        <!-- Demo Js -->
        <script src="<?php echo base_url(); ?>adminBSB/js/demo.js"></script>
        <script type="text/javascript">
            $(".select2").select2({
                    width: '100%'
            });

            $(function () {
            //Textare auto growth
            autosize($('textarea.auto-growth'));

            //Datetimepicker plugin
            $('.datetimepicker').bootstrapMaterialDatePicker({
                format: 'dddd DD MMMM YYYY - HH:mm',
                clearButton: true,
                weekStart: 1
            });

            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'DD MMMM YYYY',
                clearButton: true,
                weekStart: 1,
                time: false
            });

            $('.timepicker').bootstrapMaterialDatePicker({
                format: 'HH:mm',
                clearButton: true,
                date: false
            });
        });
        </script>
        <script type="text/javascript">
$(function(){

    $(document).on("click",".logout",function(){
        var edit_url=$(this).attr("href");
        swal({
            title:"Yakin Mau Keluar?",
            // text:"",
            showCancelButton: true,
            confirmButtonColor: "#dc143c",
            confirmButtonText: "Logout",
            closeOnConfirm: false,
        },
            function(){

             window.location.href = edit_url;
            

        });
        return false;
    });

});
</script>
    </body>

</html>