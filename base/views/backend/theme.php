<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo ucwords(str_replace('_', ' ', $this->router->class)).' - '.ucwords(str_replace('_', ' ', $this->router->method)); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="BTS Application, BTS Project" name="description" />
        <meta content="" name="author" />
        <!-- Google Font -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/vendor/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                
        <link href="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/vendor/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url()?>assets/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url()?>assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url()?>assets/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url()?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/all.css">

        <link rel="shortcut icon" href="favicon.ico" />
        
        <style>
        .table th {
            text-align: center;
            text-transform: uppercase;
        }
        form label {
            text-align: left !important;
        }
        .detailnya label {
            font-weight: bold !important;
        }
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: #fff !important;
            opacity: 1;
        }
        .height-15 {
            height: 15px;
        }

        <?php echo $this->apps->get_css(); ?>
        </style>
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary modal-confirm">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <div class="page-wrapper">
            <div class="page-header navbar navbar-fixed-top">
                <div class="page-header-inner ">
                    <!-- Logo -->
                    <div class="page-logo">
                        <a href="<?php echo site_url('/../gaia/index.php')?>">
                            <img src="<?php echo base_url()?>assets/img/pt-citra-gaia.png" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">                           
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default" id="notif_count"> 3 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>Terdapat
                                            <span class="bold">3</span> Notifikasi</h3>
                                        <a href="<?php echo site_url('notification')?>">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283" id="notif_ul">
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <i class="icon-bell"></i></span>
                                                    <span class="subject">
                                                        <span class="from">BAUT Belum Invoice</span>
                                                        <span class="time">10/04/2018</span>
                                                    </span>
                                                    <span class="message">BAUT dengan ID=B01, Project=PRJ0001, Tgl 10/04/2018</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <i class="icon-bell"></i></span>
                                                    <span class="subject">
                                                        <span class="from">Project Aktif</span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <i class="icon-bell"></i></span>
                                                    <span class="subject">
                                                        <span class="from">Project Aktif</span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>                                                                                    
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?php echo base_url()?>assets/img/avatar3_small.jpg" />
                                    <span class="username username-hide-on-mobile"> <?php echo SessionManager::getUsername(); ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-user"></i> Profil User </a>
                                    </li>
                                    <li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> Edit User </a>
                                    </li>
                                    <li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> Ubah Password </a>
                                    </li>                                    
                                    <li class="divider"> </li>                                    
                                    <li>
                                        <a href="<?php echo base_url('logout')?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>                                                        
                        </ul>
                    </div>
                    
                </div>
            </div>
            <div class="clearfix"> </div>
            <div class="page-container">
                <div class="page-sidebar-wrapper">
                    <div class="page-sidebar navbar-collapse collapse">
                        <?php $this->load->view('backend/sidebar')?>
                    </div>
                </div>
                <div class="page-content-wrapper">
                    <div class="page-content" style="min-height: 676px;">
                        <?php $this->load->view('backend/'.$tema)?>
                    </div>
                </div>
            </div>
            <div class="page-footer">
                <div class="page-footer-inner"> 2018 &copy; PT.GAIA BTS Application Version 1.0</div>
                <div class="page-footer-inner pull-right">Page rendered in <strong>{elapsed_time}</strong> seconds</div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
        </div> <!-- end page-wrapper -->

    <!-- JS File -->
    <script src="<?php echo base_url()?>assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables/media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url()?>assets/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/jsapps.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/notification.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/layout.min.js" type="text/javascript"></script>

    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

    <script>
    $(function(){
        <?php echo $this->apps->get_js(); ?>
        
        $('body').on('click', 'a', function(){
          try {
            if( $(this).attr('hapus') == 'ok' ){
              $('.modal-title').html('');
              $('.modal-body').html('<div class="text-center"><h3>Apakah anda yakin mau menghapus data ini ?</h3><br>Sebagai catatan, data yang dihapus tidak bisa dokembalikan</div>');
              $('.modal-footer').html('<a class="btn btn-sm btn-danger" href="'+ $(this).attr('href') +'">Iya</a><button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>');
              $('#myModal').modal('show');
              return false;
            }
          } catch(err) {
          }
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })
    
    });

    </script>
    </body>
</html>
<?php
if(ENVIRONMENT == 'development'){

  $enable_profiler = $this->output->enable_profiler(TRUE);

  $array = json_decode(json_encode($enable_profiler), True);

  unset($final_output);
}
?>