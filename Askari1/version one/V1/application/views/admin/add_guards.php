<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/css/bootstrap.min.css"); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.css"); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/dist/css/AdminLTE.css
    "); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/dist/css/skins/_all-skins.min.css"); ?>">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php  $this->load->view("admin/common/common_header"); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php  $this->load->view("admin/common/common_sidebar"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                 <section class="content-header">
                    <h1>
Add Guards
                        <small>  </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line("Admin");?></a></li>
                        <li><a href="#">Add Guards</a></li>
                        
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6 col-md-6">
                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message');
                                    unset($_SESSION['message']);
                                    ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>

                                </div><!-- /.box-header -->
                                <form action="" method="post" enctype="multipart/form-data" style="font-size:initial">
                                    <div class="box-body">
                                     <!--  <div class="form-group">
                                            <label class="">Date<span class="text-danger">*</span></label>
                                            <input type="text" name="date" class="form-control" placeholder="Date"/>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="">Guard Id<span class="text-danger">*</span></label>
                                            <input type="text" name="guard_id" class="form-control" placeholder="Guard ID" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="">Agency Name<span class="text-danger">*</span></label>
                                            <input type="text" name="agency" class="form-control" placeholder="Agency Name" required />
                                        </div>
                                        
                                         <div class="form-group">
                                            <label class="">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="">Mobile No.<span class="text-danger">*</span></label>
                                            <input type="text" name="mobile" class="form-control" placeholder="Mobile No" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Shift Start Time<span class="text-danger">*</span></label>
                                            <input type="time" name="start" class="form-control" placeholder="" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="">Shift End Time<span class="text-danger">*</span></label>
                                            <input type="time" name="end" class="form-control" placeholder="" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="">Password<span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control" placeholder="password" required />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="">Confirm Password<span class="text-danger">*</span></label>
                                            <input type="password" name="conf_password" class="form-control" placeholder="re-enter password" required />
                                        </div>
                                      
                                    </div><!-- /.box-body -->
                                            
                                    <div class="box-footer">
                                        <input type="submit" class="btn " style="background-color:#00887a; color:white" name="submit" value="Add" id="sub"/>
                                        
                                         <input type="submit" class="btn btn-primary" name="pay" value="Pay" id="pay" style="display:none"/>
                                       
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <!-- Main row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- /.content-wrapper -->
      
      <?php  $this->load->view("admin/common/common_footer"); ?>  

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
    <script>
      $(function () {
        
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": true,
        });
        $("body").on("change",".tgl_checkbox",function(){
            var table = $(this).data("table");
            var status = $(this).data("status");
            var id = $(this).data("id");
            var id_field = $(this).data("idfield");
            var bin=0;
                                         if($(this).is(':checked')){
                                            bin = 1;
                                         }
            $.ajax({
              method: "POST",
              url: "<?php echo site_url("admin/change_status"); ?>",
              data: { table: table, status: status, id : id, id_field : id_field, on_off : bin }
            })
              .done(function( msg ) {
                alert(msg);
              }); 
        });
      });
    </script>
  </body>
</html>
