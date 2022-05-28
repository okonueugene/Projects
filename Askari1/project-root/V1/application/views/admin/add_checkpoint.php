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
Add Checkpoints
                        <small>  </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line("Admin");?></a></li>
                        <li><a href="#">Add Checkpoints</a></li>
                        
                    </ol>
                </section>
<?php $code=substr(md5(time()),5,5);?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12 col-lg-8 col-md-8">
                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message'); ?>
                            <div class="box box-primary">
                               
                                <form action="" method="post" enctype="multipart/form-data" style="font-size:initial">
                                    <div class="box-body">
                                     <!--  <div class="form-group">
                                            <label class="">Date<span class="text-danger">*</span></label>
                                            <input type="text" name="date" class="form-control" placeholder="Date"/>
                                        </div> -->
                                         <div class="form-group">
                                            <label class="" style="font-size:12pt">Select Mode<span class="text-danger">*</span></label>
                                        
                                            <h4><input type="radio" name="mode" style="width: 0.8em; height: 0.8em; " value="auto" checked=true; onclick="document.getElementById('print').style.display='inline';document.getElementById('image').value='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+document.getElementById('codex').value; document.getElementById('code').style.display='none';document.getElementById('img').src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+document.getElementById('codex').value; document.getElementById('lbl').innerHTML='Code: '+document.getElementById('codex').value; document.getElementById('codexx').value=document.getElementById('codex').value"   /> <b>Auto</b>
                                        <input type="radio" name="mode" style="width: 0.8em; height: 0.8em; "  value="manual" onclick="document.getElementById('print').style.display='none';document.getElementById('code').style.display='block';document.getElementById('img').src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=----'; document.getElementById('lbl').innerHTML='Code: ----';document.getElementById('codexx').value='';"  required /><b>Manual</b></h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="">Checkpoint Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="checkpoint Name" required />
                                        </div>
                                        
                                        
                                        
                                         <div class="form-group">
                                            <label class="">Location<span class="text-danger">*</span></label>
                                            <input type="text" name="location" class="form-control" placeholder="location" required />
                                    <input type="hidden" value="<?php echo $code;?>" id='codex' required>
                                    <input type="hidden" value="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $code;?>" name='image' id='image'>
                                        </div>
                                        
                                        <div class="form-group" id='code' style="display:none">
                                            <label class="">Code<span class="text-danger">*</span></label>
                                            <input type="text" value="<?php echo $code;?>" class="form-control" name='code' onkeyup="document.getElementById('lbl').innerHTML='Code: '+this.value; document.getElementById('img').src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+this.value; document.getElementById('image').value='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+this.value;" id='codexx' required>
                                        </div>
                                    </div><!-- /.box-body -->
                                            
                                    <div class="box-footer">
                                        <input type="submit" class="btn " style="background-color:#00887a; color:white; width:130px" name="submit" value="Save" id="sub"/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="submit" class="btn " style="background-color:#00887a; color:white; width:130px" name="print" value="Save & Print" id="print"/>
                                
                                      
                                      
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                        
                        
                        
                        <div class="col-xs-12 col-lg-4 col-md-4" id="qrcode" style="text-align:center">
                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message'); 
                                    unset($_SESSION['message']);
                                    ?>
                            <div class="box box-primary">
                            
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                     <!--  <div class="form-group">
                                            <label class="">Date<span class="text-danger">*</span></label>
                                            <input type="text" name="date" class="form-control" placeholder="Date"/>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="" ><b><h3 id='lbl' style="font-weight:bold;">Code:   <?php echo $code;?> </h3></b></label>
                                            
                                        </div>
                                         <div class="form-group">
                                           
                                            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $code;?>" id='img'>
                                        </div>
                                        
                                    </div><!-- /.box-body -->
                                            
                                    <div class="box-footer">
                                       
                                        <br>
                                       <br>
                                        <br>
                                        <br>
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
