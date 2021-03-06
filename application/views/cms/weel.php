<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('title')?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/title.png'); ?>" />
    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/ionicons.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="<?=base_url();?>assets/plugins/morris/morris.css"> -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- clockpicker -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-clockpicker.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- GROWL NOTIFICATION -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery.growl.css">
  <!-- SELECT2 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/FixedColumns/css/dataTables.fixedColumns.min.css"></script>
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/AdminLTE.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/pace/pace.min.css">
  <link href="<?=base_url();?>assets/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body class="hold-transition skin-green-light sidebar-mini fixed">
  <style type="text/css">
  .not-active {
   pointer-events: none;
   cursor: default;
  }
  </style>
  <style type="text/css" media="screen">
  .table>tbody>tr>th,.table>tfoot>tr>th,.table>thead>tr>th {
    text-align: center;
  }
  </style>
  <div id="context">
  <div id='modal'></div>
    <div class="wrapper">

      <header class="main-header">
      <a href="#" class="logo bg-primary">
          <!-- logo for regular state and mobile devices -->
          <span class="logo-mini">
		  	<img src= "assets/img/title.png" width="25">
		  </span>
          <span class="logo-lg" ><img src="assets/img/title.png" height="30">  <?php echo $this->config->item('project')?></>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu" >
            <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="" class="dropdown-toggle" data-toggle="dropdown" >
                <!-- The user image in the navbar-->
                <?php
                    echo $avatar = parse_avatar(from_session('gambar'),from_session('nama'),30,'user-image User Image');
                      ?>
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo from_session('nama');?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                <?php
                    echo $avatar = parse_avatar(from_session('gambar'),from_session('nama'),30,'img-circle  elevation-2');
                      ?>
                      <p><?php echo from_session('nama');?> - <?php echo from_session('nama_level');?>
                      </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                  <?php echo button('load_silent("kelola/kelola_user/show_editForm_user/'.from_session('id').'","#content")','Update Profil',' btn btn-default brn-flat ');?> 
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url().'login/logout/'?>" class="btn btn-default btn-flat">Log Out</a>
                  </div>
                </li>
              </ul>
            </li>            
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel" style="background:#E8E8E8;">
            <div class="pull-left image">
              <?php
                  $avatar = parse_avatar(from_session('gambar'),from_session('nama'),60,'img-circle  elevation-2');
                ?>
              <?php echo $avatar; ?>
            </div>
            <div class="pull-left info">
              <p><font color="#bfbfbf" size="2px">Login As :</font></p>
              <p><?php echo from_session('nama_level');?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="header" style="background:#E8E8E8;"><b>Menu Utama</b></li>
            <li class="active treeview">
              
             
            </li>
            <?php foreach($menu[0] as $grup_id=>$arr_menu):?>
            <li class="treeview">
              <a href="#" id="<?=$menu[1][$grup_id]?>">
                <i class="<?php echo $menu[2][$grup_id];?>"></i> <span><?php echo $menu[1][$grup_id];?></span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php foreach($arr_menu as $row):?>
                <li><?php echo ajax_menu_adm($row->url,$row->nama);?></li>
                <?php endforeach; ?>
              </ul>
            </li>
             <?php endforeach; ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div style="min-height: 916px;"  class="content-wrapper">
        <section id="content" class="content">
             <!-- /.row -->
        </section>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer" style="background:#655c56;">
        <div class="pull-right hidden-xs">
          <b style="color: #FFFFFF">Version 1.0.0</b> 
        </div>
        <strong style="color: #FFFFFF">Copyright &copy; 2020 Kholiq.</strong>
      </footer>

      <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
    </div><!-- ./wrapper -->

 <!-- jQuery 2.1.4 -->
 <script src="assets/js/jquery-1.9.1.js"></script>
    <?php echo js('assets/js/jquery-ui.min.js') ?>
    <?php echo js('assets/plugins/pace/pace.min.js') ?>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.5 -->
    <?php echo js('assets/js/bootstrap.min.js') ?>

    <!-- Select2 -->
    <?php echo js('assets/plugins/select2/select2.full.min.js') ?>
    <?php echo js('assets/js/fileinput.min.js') ?>
    <?php echo js('assets/js/ajaxFileUpload.js') ?>
    <!-- Morris.js charts -->
    <?php echo js('assets/js/raphael-min.js') ?>
    <!-- Sparkline -->
    <?php echo js('assets/plugins/sparkline/jquery.sparkline.min.js') ?>
    <!-- jvectormap -->
    <?php echo js('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') ?>
    <!-- jQuery Knob Chart -->
    <?php echo js('assets/plugins/knob/jquery.knob.js') ?>
    <!-- daterangepicker -->
    <?php echo js('assets/js/moment.min.js') ?>
    <?php echo js('assets/js/ckeditor.js') ?>
    <?php echo js('assets/plugins/daterangepicker/daterangepicker.js') ?>
    <!-- datepicker -->
    
    <?php echo js('assets/plugins/datepicker/bootstrap-datepicker.js') ?>
    <!-- Clockpicker -->
    <?php echo js('assets/js/jquery-clockpicker.min.js') ?>
    <!-- Bootstrap WYSIHTML5 -->
    <?php echo js('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>
    <!-- Slimscroll -->
    <?php echo js('assets/plugins/slimScroll/jquery.slimscroll.min.js') ?>
    <!-- FastClick -->
    <?php echo js('assets/plugins/fastclick/fastclick.min.js') ?>
    <?php echo js('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>
    <!-- AdminLTE App -->
    <?php echo js('assets/js/jquery.blockUI.js') ?>
    <?php echo js('assets/js/app.min.js') ?>
    <?php echo js('assets/js/bootapp_back.js') ?>
    <?php echo js('assets/plugins/fullcalendar/fullcalendar.min.js') ?>

    <!-- GROWL NOTIFICATION -->
    <?php echo js('assets/js/jquery.growl.js') ?>


    <?php echo js('assets/plugins/input-mask/jquery.inputmask.js') ?>
    <?php echo js('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') ?>
    <?php echo js('assets/plugins/input-mask/jquery.inputmask.extensions.js') ?>

    <!-- DataTables -->
    <?php echo js('assets/plugins/datatables/jquery.dataTables.min.js') ?>
    <?php echo js('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>
    <?php echo js('assets/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js') ?>
    <?php echo js('assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') ?>
    <?php echo js('assets/js/dataTables.fixedColumns.min.js') ?>

    <script>
    $(document).ajaxStart(function() { Pace.restart(); });
    var site = '<?php echo site_url();?>';
    var base = '<?php echo base_url();?>';
    var gbr1 = '<?php echo base_url().'assets/img/loaders/biru.jpg'; ?>'
    var gbr2 = '<?php echo base_url().'assets/img/loaders/4.gif'; ?>'
      $.widget.bridge('uibutton', $.ui.button);
    $(function() {
      $('#Dashboard').click();
    });
    </script>
  
  </body>
</html>
 
