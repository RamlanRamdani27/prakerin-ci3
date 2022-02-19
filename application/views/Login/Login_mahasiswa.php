<html class="chrome"><head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $title;?></title>
        
    <link rel="icon" href="<?php echo base_url(); ?>adminBSB/images/Politeknik.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>adminBSB/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>adminBSB/plugins/node-waves/waves.css" rel="stylesheet">

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>adminBSB/plugins/animate-css/animate.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>adminBSB/css/style.css" rel="stylesheet">
</head>

<body class="login-page ls-closed">
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
        
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><img align="center" alt="" src="<?php echo base_url()?>/adminBSB/images/Politeknik.png" width="70px" height="70px"></a>
            <small><br>POLITEKNIK SUKABUMI</small>
        </div>
        <div class="card">
            <div class="body">

                <form id="sign_in" method="POST" novalidate="novalidate" action="<?php echo base_url()?>/login/ceklogin_mahasiswa">
                    <div class="msg">Sistem Informasi<b> Prakerin</b></div>
                     <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="txtusername" placeholder="Nim" required="" autofocus="" aria-required="true">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="txtpassword" placeholder="Password" required="" aria-required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>adminBSB/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>adminBSB/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url(); ?>adminBSB/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>adminBSB/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>adminBSB/js/pages/examples/sign-in.js"></script>
    <script type="text/javascript">
        $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
    </script>

</body>
</html>